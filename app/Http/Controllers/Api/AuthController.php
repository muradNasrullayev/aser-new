<?php

namespace App\Http\Controllers\Api;

use App\EmailListContent;
use App\Http\Controllers\Controller;
use App\Notifications\Emails;
use App\TokensForLogin;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\OTP;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\ResetsPasswords;

class AuthController extends Controller
{
    use ResetsPasswords;
	public function login(Request $request)
	{
		$user = User::where('email', $request->email)->whereNotNull('email_verified_at')->first();
		// dd($user);
		if (!$user || !Hash::check($request->password, $user->password)) {

			return response([
					'status' => Response::HTTP_FORBIDDEN,
					'message' => 'The provided credentials are incorrect or email not verified.',
					'errorKey' => 'error.auth.incorrect'
			], Response::HTTP_FORBIDDEN);
		}
		$token = Str::random(255);
		TokensForLogin::create([
				'token' => $token,
				'client_id' => $user->id,
				'created_by' => $user->id,
				'created_time' => time()
		]);

		return response([
			'token' => $token,
			'message' => 'Success',
		], 200);
	}

	public function logout(Request $request)
	{
		$user = User::where('email', $request->email)->first();

        if ($user == null){
            return response([
                'status' => Response::HTTP_NOT_FOUND,
                'message' => 'User not found',
            ], Response::HTTP_NOT_FOUND);
        }

		TokensForLogin::where('token', Str::substr(\Illuminate\Support\Facades\Request::header('Authorization'), 7))->delete();
		DB::table('user_devices')->where('device_id', Str::substr(\Illuminate\Support\Facades\Request::header('Authorization'), 7))->delete();
		return response([
				'status' => Response::HTTP_OK,
				'message' => 'You Have Successfully Logged Out',
		], Response::HTTP_OK);
	}

    public function new_password(Request $request){
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'new_password' => ['required','min:8'],
            'confirm_password' => ['required','min:8','same:new_password']
        ]);
        if ($validator->fails()) {
            return response(['case' => 'warning', 'title' => 'Warning!', 'type' => 'validation', 'content' => $validator->errors()->toArray()],422);
        }
        $user = User::where('id',$request->user_id)->first();

        if(!$user){
            return response()->json([ 'status'=>false,'message'=>'Müştəri tapılmadı'],400);
        }
        if (!($request->new_password==$request->confirm_password)){
            return response()->json([ 'status'=>false,'message'=>'New password and confirm password is incorrect'],400);
        }
        $user->update([
            'password' => Hash::make($request->new_password)
        ]);

        return response()->json([
            'status'=>true,
            'message'=>'Password changed successfully'
        ]);
    }


    public function checkOTP(Request $request){
        $validatedData = Validator::make($request->all(),[
            'email' => 'required',
            'otp' => 'required',
        ]);
        if($validatedData->fails()){
            $messages = $validatedData->messages();
            return response()->json(['status'=>false,"errors" => $messages],422);
        }

        $user=User::where('email',$request['email'])->first();
        if(!$user){
            return response()->json([
                'status' => false,
                'message' => 'Müştəri tapılmadı'
            ],400);
        }

        $otp = OTP::query()
            ->where('client_id', $user->id)
            ->select('otp')
            ->orderByDesc('id')
            ->first();

        if (!$otp) {
            return response()->json([
                'status' => false,
                'message' => 'No OTP found for this user'
            ],400);
        }


        if ($request['otp'] != $otp->otp) {
            return response()->json([
                'status' => false,
                'message' => 'OTP code is wrong'
            ],400);
        }

        return response()->json([
            'status' => true,
            'user_id'=> $user->id,
            'message' => 'OTP code is true'
        ],200);

    }


	public function test(Request $request)
	{
		$user = User::where('id', $request->get('user_id'))->get();
		return $user;
	}

    public function sendResetLinkEmail(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if ($user) {
            $this->broker()->sendResetLink(
                $this->credentials($request)
            );
            Session::flash('message', __('forgot_password.sent_email_success_message'));
            Session::flash('class', 'success');
            Session::flash('display', 'block');
            return \response([
                'case' => 'success',
                'message' => __('forgot_password.sent_email_success_message')
            ]);
        } else {
            Session::flash('message', __('forgot_password.sent_email_failed_message'));
            Session::flash('class', 'danger');
            Session::flash('display', 'block');
            return \response([
                'case' => 'error',
                'message' => __('forgot_password.sent_email_failed_message')
            ]);
        }

    }

    public function reset_password(Request $request)
    {
        $user = User::where('email', $request->email)->first();


        if ($user) {
            $email = EmailListContent::where(['type' => 'password_changed'])->first();

            if ($email) {
                $client = $user->full_name();
                $lang = strtolower($user->language());

                $email_title = $email->{'title_' . $lang}; //from
                $email_subject = $email->{'subject_' . $lang};
                $email_bottom = $email->{'content_bottom_' . $lang};
                $email_content = $email->{'content_' . $lang};

                $email_content = str_replace('{name_surname}', $client, $email_content);

                $user->notify(new Emails($email_title, $email_subject, $email_content, $email_bottom));
            }

            return $this->sendResetResponse($request, 'succes');
        } else {
            return $this->sendResetFailedResponse($request, 'fail');
        }
    }
}
