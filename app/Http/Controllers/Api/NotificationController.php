<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\TokensForLogin;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class NotificationController extends Controller
{

    private $userID;

    public function __construct(Request $request)
    {
        //		$this->middleware(['auth', 'verified']);
        $this->middleware(function ($request, $next) {

            if ($request->get('api')) {
                App::setlocale($request->get('apiLang') ?? 'en');
                $this->userID = $request->get('user_id');

                if (Auth::guest()) {
                    $user = User::find($this->userID);
                    Auth::login($user);
                }
            } else {
                $this->userID = Auth::id();
            }
            return $next($request);
        });
    }

    public function CreatOrUpdateUserDevice(Request $request){
        try {
            $authKey = Str::substr($request->header('Authorization'), 7);
            $userDevice = DB::table('user_devices')->where('device_id', $authKey)->first();

            if ($userDevice != null){
                DB::table('user_devices')->where('device_id', $authKey)->update([
                    'fcm_token' => $request->fcm_token
                ]);

                return response()->json([
                    'title' => 'Token updated successfully.',
                    'fcm_token' => $request->fcm_token
                ]);
            }else{
                $token = TokensForLogin::where('token', $authKey)->first();

                if ($token !== null) {
                    DB::table('user_devices')->insert([
                        'fcm_token' => $request->fcm_token,
                        'device_id' => $authKey,
                        'user_id' => $token->client_id
                    ]);

                    return response()->json([
                        'title' => 'Token saved successfully.',
                        'fcm_token' => $request->fcm_token
                    ]);
                } else {
                    return response()->json([
                        'error' => 'Token not found.'
                    ], 404);
                }
            }


        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }


    }

    public function GetNotifications(Request $request){
        $authorizationHeader = $request->header('Authorization');

        if (Str::startsWith($authorizationHeader, 'Bearer ')) {
            $authKey = Str::substr($authorizationHeader, 7);

            $notifications = DB::table('user_devices')
                ->join('user_notification_details', 'user_devices.user_id', '=', 'user_notification_details.client_id')
                ->where('user_devices.device_id', $authKey)
                ->select(
                    'user_notification_details.id',
                    'user_notification_details.client_id',
                    'user_notification_details.subject_header',
                    'user_notification_details.is_read',
                    'user_notification_details.created_at'
                )->orderByDesc('user_notification_details.id')
                ->paginate(15);

            return response()->json($notifications);
        }
    }

    public function ReadSingleNotification($clientId, $readId, $selectedtItem = 1){
        try {
            $notification = DB::table('user_notification_details')
                ->where('id', $readId)
                ->first();

            if ($notification->is_read == 0){
                DB::table('user_notification_details')->where('id', $readId)->update([
                    'is_read' => 1
                ]);
                $this->DecrementUserRead($clientId, $selectedtItem);
            }

            return response([
                'Title' => $notification->subject_header,
                'Content' => $notification->subject_content
            ]);
        }catch (\Exception $exception){
            //dd($exception);
            return 'error';
        }

    }

    public function ReadAllNotification(Request $request){
        $validator = Validator::make($request->all(), [
            'notification' => 'required|array'
        ]);

        if ($validator->fails()) {
            Log::info('notification_read_all_validation_fail', $validator->errors()->toArray());
            return response()->json([
                'message' => 'validation failed',
                'request' => $request->all(),
                'errors' => $validator->errors()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        try {
            $notifiArray = $request->notification;

            $notificationCount = DB::table('user_notification_details')
                ->whereIn('id', $notifiArray)
                ->where('is_read', 0)
                ->where('client_id', $this->userID)
                ->select('id', 'client_id', 'is_read')
                ->get();

            if ($notificationCount->count() > 0){

                DB::table('user_notification_details')->whereIn('id', $notificationCount->pluck('id')->toArray())->update([
                    'is_read' => 1
                ]);

                $this->DecrementUserRead($this->userID, $notificationCount->count());

                return response()->json([
                    'message' => 'Success'
                ], Response::HTTP_OK);

            }else{
                return response()->json([
                    'message' => 'Notifications not found'
                ], Response::HTTP_NOT_FOUND);
            }
        }catch (\Exception $exception){
            //dd($exception);
            return 'error';
        }
    }

    private function DecrementUserRead($clientId, $count): void {
        $user = User::find($clientId);
        if ($user->read_notification_count > $count) {
            $user->decrement('read_notification_count', $count);
        } else {
            $user->read_notification_count = 0;
            $user->save();
        }
    }

}
