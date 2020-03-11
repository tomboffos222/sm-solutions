<?php

namespace App\Http\Controllers;

use App\Cat;
use App\Course;
use App\CourseVideo;
use App\Payment;
use App\UserBalanceOperation;
use App\UserCell;
use App\UserCellRefer;
use App\User;
use App\Message;

use App\UserWithdraw;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use const http\Client\Curl\Versions\IDN;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
   /* public function __construct()
    {
        $this->middleware('auth');
    }




    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function InstaDesign(){
        $user = session()->get('user');
        $data['user'] = User::find($user['id']);

        return view('instadesign');
    }
    public function index()
    {
        $user = session()->get('user');
        $data['user'] = User::find($user['id']);
        $data['courses'] = Course::join('course_videos','courses.id','=','course_videos.course_id')->select('courses.*','url')->orderBy('created_at','desc')->paginate(2);
        $data['refers'] = User::where('referBy',session()->get('user')->id)->get() ;
        $data['cell'] = UserCell::where('user_id',$user['id'])->sum('cell_count')+ User::join('user_cells','user_cells.user_id','=','users.id')->where('accountBy',$user['id'])->sum('cell_count');
        $data['linkers'] = User::where('referBy','!=', null)->get();
        $data['accountsNum'] = User::where('accountBy',$user['id'])->count();

        $data['accounts'] = User::join('user_cells','user_cells.user_id','=','users.id')->select('users.*','user_cells.user_id','user_cells.cell_count')->where('accountBy',$user['id'])->get();






        return view('home',$data);
    }
    public function LoginPage(){
        return view('login');
    }
    public function Login(Request $request){
        $rules = [
            'login'=> 'required|max:255|exists:users,login',
            'password'=> 'required|min:4:max:255',
        ];
        $messages = [
            'login.exists'=>'Неправильный логин или пароль'
        ];
        $validator = $this->validator($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return back()->withErrors($validator->errors()->first());
        }
        $user =  User::whereLogin($request['login'])->first();
        if (!Hash::check($request['password'],$user->password)){
            return back()->withErrors('Неправильный логин или пароль');
        }
        session()->put('user',$user);
        session()->save();
        return redirect()->route('Welcome');

    }
    public function Logout(){
        session()->forget('user');
        return redirect()->route('LoginPage')->withErrors('Вы вышли');

    }
    public function RegisterPage(){
        return view('register');

    }
    public function Courses(){
        $user = session()->get('user');
        $data['user'] = User::where('id',$user['id'])->first();
        $exception = UserBalanceOperation::whereUserId($user['id']);


        $data['cats'] = Cat::paginate(12);

        return view('courses',$data);
    }
    public function Course($id){
        $user = session()->get('user');
        $data['user'] = User::where('id',$user['id'])->first();
        $data['courses'] = Course::where('cat_id',$id)->join('course_videos','courses.id','=','course_videos.course_id')->select('courses.*','url')->orderBy('created_at','desc')->paginate(6);

        return view('course',$data);
    }

    public function Profile(){
        $user = session()->get('user');

        $data['user'] = User::where('id',$user['id'])->first();
        return view('profile',$data);
    }
    public function QuestionPage(){
        $user = session()->get('user');
        $data['messages'] = Message::where('user_id',$user['id'])->orderBy('created_at','desc')->paginate(2);

        $data['user'] = User::where('id',$user['id'])->first();
        return view('question',$data);
    }
    public function Test(Request $request){
        $user = session()->get('user');
        $user = User::find($user['id']);
        $payment = new Payment();
        $payment['user_id'] = $user->id ;
        $payment['sum'] = 12000;
        $payment['status'] = 'waiting';
        $payment['description'] = 'Статус партнера';
        $payment->save();
        $data['MERCHANT_ID'] = 17274;
        $data['PAYMENT_AMOUNT'] = 12000;
        $data['PAYMENT_ORDER_ID'] = $payment->id;
        $data['PAYMENT_INFO'] = 'Оплата за статус партнер логин'.$user->id;
        $data['PAYMENT_RETURN_URL'] = route('SuccessAcc');
        $data['PAYMENT_RETURN_FAIL_URL'] = route('FailPayment');
        $data['PAYMENT_CALLBACK_URL'] = route('PaymentResult');
        ksort($data);
        $str = '';
        foreach ($data as $d){
            $str .= $d;
        }
        $secret_key = 'f4f84866-5dd3-11ea-98a5-448a5bd44871';
        $signature = base64_encode(pack("H*", md5($str.$secret_key)));//
        $data['PAYMENT_HASH'] =$signature;


        $res = self::SendReq('https://spos.kz/merchant/api/create_invoice',$data);
        if ($res->status == 0){
            session()->put('user',$user);
            session()->save();
            return redirect($res->data->url);
        }else{
            return redirect()->back();
        }
    }
    public function Partner(){
        $user = session()->get('user');
        $data['user'] = User::find($user['id']);
        return view('partner',$data);
    }
    public function Create(Request $request){
        $rules = [
            'name'=> 'required|max:255',
            'login'=>'required|unique:users,login',
            'password'=> 'required|min:8:max:11',
            'phone'=> 'required|unique:users,phone|digits:11',
            'email'=> 'required|email|max:255',
        ];
        $messages = [
            "phone.unique" => "Этот номер телефона занят",
            "phone.required" =>"Введите номер телефона",
            "login.required" => "Логин обязателен",
            "login.unique" =>"Логин уже занят",
            "phone.max:11" =>"Количество символов в номере не должно превышать 11 символов ",
            "password.min" => "Количество символов в пароле минимум 8",
            "password.max" =>  "Количество символов в пароле максимум 11"
        ];
        $validator = $this->validator($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return back()->withErrors($validator->errors()->first());
        }

        if ($request['referBy']){
            $userCellSum =  UserCell::whereUserId($request['referBy'])->sum('max_cell_count');
            $userCount = User::where('referBy',$request['referBy'])->count();

            if ($userCellSum <= $userCount){
                return back()->withErrors('Нет пустой ячейки');
            }
        }

        $user = new User();

        $user->name = $request['name'];
        $user->login = $request['login'];
        $user->status = 'registered';
        $user->password = bcrypt($request['password']);
        $user->phone = $request['phone'];
        $user->email = $request['email'];
        $user->referBy = $request['referBy'];
        $user->save();

        $userCell = new UserCell();
        $userCell->user_id = $user->id;
        $userCell->save();

        $payment = new Payment();
        $payment['user_id'] = $user->id ;
        $payment['sum'] = 12000;
        $payment['status'] = 'waiting';
        $payment['description'] = 'Статус партнера';
        $payment->save();
        $data['MERCHANT_ID'] = 17274;
        $data['PAYMENT_AMOUNT'] = 12000;
        $data['PAYMENT_ORDER_ID'] = $payment->id;
        $data['PAYMENT_INFO'] = 'Оплата за статус партнер логин'.$user->id;
        $data['PAYMENT_RETURN_URL'] = route('SuccessAcc');
        $data['PAYMENT_RETURN_FAIL_URL'] = route('FailPayment');
        $data['PAYMENT_CALLBACK_URL'] = route('PaymentResult');
        ksort($data);
        $str = '';
        foreach ($data as $d){
            $str .= $d;
        }
        $secret_key = 'f4f84866-5dd3-11ea-98a5-448a5bd44871';
        $signature = base64_encode(pack("H*", md5($str.$secret_key)));//
        $data['PAYMENT_HASH'] =$signature;


        $res = self::SendReq('https://spos.kz/merchant/api/create_invoice',$data);
        if ($res->status == 0){
            session()->put('user',$user);
            session()->save();
            return redirect($res->data->url);
        }else{
            return redirect()->back();
        }







    }
    private static function SendReq($url,$params) {
        // Set POST variables

        $headers = array(

            'Content-Type: application/json'
        );
        // Open connection
        $ch = curl_init();

        // Set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));

        // Execute post
        $result = curl_exec($ch);
        // echo "Result".$result;
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }

        // Close connection
        curl_close($ch);

        return json_decode($result);
    }
    public function QuestionCreate(Request $request){
        $rules = [
          'question'=> 'required|max:255',
          'user_id'=>'required|max:255'
        ];
        $messages = [
          "question.required" => "Введите свой вопрос",
          "question.max" => "Допустимое количество символов 255"
        ];
        $validator = $this->validator($request->all(),$rules,$messages);
        if ($validator->fails()){
            return back()->withErrors($validator->errors());
        }else{
            $message = new Message;
            $message['question'] = $request['question'];
            $message['answer'] = 0;
            $message['user_id'] = $request['user_id'];
            $message->save();
            return back()->with('message','Сообщение отправлено');

        }

    }

    public function Welcome(){
        $user = session()->get('user');
        if ($user) {
                $data['user'] = User::find($user['id']);

            }else{


        }
        return view('welcome');

    }
    public function SuccessRefill(){
        $user = session()->get('user');
        $user = User::find($user['id']);

        $payment = Payment::where('user_id',$user['id'])->where('status','waiting')->orderBy('created_at','desc')->first();
        $payment['status'] = 'ok';
        $payment->save();
        $user['balance'] = $user['balance']+$payment['sum'];
        $user->save();
        return redirect()->route('home')->with('message','Операция проведена успешно');

    }
    public function FailPayment(){
        $user = session()->get('user');
        $payment = Payment::where('user_id',$user['id'])->where('status','waiting')->orderBy('created_at','desc')->first();
        $payment['status'] = 'fail';
        $payment->save();
        return redirect()->route('home')->withErrors('Недостаточно средств или ошибка');

    }
    public function PaymentResult(Request $request){
        Storage::put('pay.log',$request->all());

        $payment = Payment::find($request['PAYMENT_ORDER_ID']);
        $user = User::find($payment->user_id);


        if ($request['PAYMENT_STATUS'] == 'paid') {
            $payment['status'] = 'ok';
            $payment->save();




            $user =User::find($user['id']);

            if ($user) {
                $user = User::find($user['id']);
                $user['status'] = 'partner';
                $user->save();


            }

            if ($user['referBy']) {
                $userCell = UserCell::whereStatus(0)->whereUserId($user['referBy'])->where('cell_count', '<', 2)->orderBy('cell_count', 'desc')->first();
                if (!$userCell) {
                    return back('Ошибка');
                }

                $userCellRefer = new UserCellRefer();
                $userCellRefer->user_cell_id = $userCell->id;
                $userCellRefer->user_id = $user->id;
                $userCellRefer->save();


                $userCell->cell_count = UserCellRefer::whereUserCellId($userCell->id)->count();
                $userCell->save();
                $userAcc = User::where('id', $user['referBy'])->first();


                $this->CellSum($user['referBy']);


            }


            return "RESULT=OK";

        }else{


            $payment = Payment::find($request['PAYMENT_ORDER_ID']);
            $payment['status'] = 'fail';
            $payment['description'] = $request;

            if ($payment = $payment->save()){
                return "RESULT=RETRY";
            }else {
                return "RESULT=RETRY";
            }
        }
    }
    public function SuccessAcc(){

        $user = session()->get('user');
        $payment = Payment::where('user_id',$user['id'])->orderBy('id','desc')->first();



        return redirect()->route('Welcome')->with('message', 'Ваш аккаунт переведен в статус партнера');


    }

    public function RefillBalance(Request $request){
        $rules = [
          'amount'  => 'required'
        ];
        $messages = [
          'amount.required' => 'Введите сумму пополнения баланса'
        ];
        $validator = $this->validator($request->all(),$rules, $messages);
        if ($validator->fails()){
            return back()->withErrors($validator->errors());

        }else{
            $user = session()->get('user');
            $user = User::find($user['id']);
            $payment = new Payment();
            $payment['sum'] = $request['amount'];
            $payment['user_id'] = $user['id'];
            $payment['description'] = 'Пополнение баланса';
            $payment->save();




            define('API_TOKEN', '@1S_ab2#KGihXjI8B3Czgs7AO6905kHu4!pJ');

            $body = [
                'operator_id' => 18,
                'order_id' => $payment['id'],

                'amount' => $request['amount'],

                'description' => 'Перевод на статус партнера',
                'success_url' => route('SuccessRefill'),
                'fail_url' => route('FailPayment'),
                'result_url' => 'https://indigo24.com/result.php',
            ];


            $request = json_encode($body);
            $signature = md5($request . API_TOKEN);

            $query = http_build_query([
                'body' => $request,
                'signature' => $signature,
            ]);

            $options = [
                'http' => [
                    'method' => 'POST',
                    'header' => join("\r\n", [
                        'Content-Type: application/x-www-form-urlencoded',
                        'Accept: application/json',
                    ]),
                    'content' => $query,
                ],
            ];

            $context = stream_context_create($options);

            $result = file_get_contents('https://billing.indigo24.xyz/api/v1/payment', false, $context);
            $result = json_decode($result);

            return redirect($result->redirect_url);
        }

    }
    public function ResetPass(){
        return view('reset');
    }
    public function SendPass(Request $request){
        $rules = [
            'mail' => 'required'
        ];
        $messages = [
            "mail.required" => "Введите почту"
        ];
        $validator = $this->validator($request->all(),$rules,$messages);
        if ($validator->fails()){
            return back()->withErrors($validator->errors());
        }else{
            $user = User::where('email',$request['mail'])->where('phone',$request['phone'])->first();
            if($user){
                $to      = $request['mail'];
                $subject = 'Изменение пароля';
                $message = 'Изменение пароля'. "\t".$request['mail'] .','. $request['phone']."\n"."Перейдите по ссылке чтобы поменять пароль"."\t" .route('EditPass',$user->id) ;
                $headers = 'From: webmaster@example.com' . "\r\n" .
                    'Reply-To: webmaster@example.com' . "\r\n" .
                    'X-Mailer: PHP/' . phpversion();

                if(mail($to, $subject, $message, $headers)){
                    return back()->with('message','Вам отправлено письмо на почту');

                }else{
                    return back()->withErrors('ошибка');
                }
            }else{
                return back()->withErrors('Такого аккаунта не существует');
            }
        }
    }
    public function EditPass($id){
        $data['user'] = User::find($id);
        return view('editpass',$data);
    }
    public function PassConfirm(Request $request){
        $rules = [
            'password' => 'required|min:4'
        ];
        $messages = [
            "password.required" => "Введите пароль",
            "password.min" => "Минимальное количество символов  4"
        ];
        $validator = $this->validator($request->all(),$rules,$messages);
        if ($validator->fails()){
            return back()->withErrors($validator->fails());
        }else{
            $user = User::find($request['user_id']);

            $user['password'] = $request['password'];
            $user->save();
            return redirect()->route('LoginPage')->with('message','Изменено');
        }
    }
    public function Bonus(){
        $user = session()->get('user');
        $data['user'] = User::where('id',$user['id'])->first();
        $data['bonuses'] = UserBalanceOperation::where('user_id',$user['id'])->orderBy('created_at','desc')->paginate(12);
        return view('bonus',$data);
    }
    public function Withdraws(){
        $user = session()->get('user');
        $data['user'] = User::find($user['id']);
        $data['withdraws'] = UserWithdraw::where('user_id',$user['id'])->paginate(12);

        return view('withdraws',$data);
    }
    public function  WithdrawCreate(Request $request){
        $rules = [
            'phone' => 'required',
            'sum' => 'required'
        ];
        $message = [
            'phone.required'=> 'Введите номер телефона',
            'sum.required' => 'Введите сумму вывода'
        ];
        $validator = $this->validator($request->all(),$rules,$message);
        if ($validator->fails()){
            return back()->withErrors($validator->errors());
        }else{
            $user = session()->get('user');
            $user = User::find($user['id']);
            $sum = $user['balance'] - $request['sum'];

            $accounts = User::where('accountBy',$user['id'])->pluck('id');


            $user = session()->get('user');
            $user = User::find($user['id']);

            if ($sum >= 0){
                    $user = session()->get('user');
                    $user = User::find($user['id']);
                    $user['balance'] = $user['balance'] - $request['sum'];
                    $user->save();
                    $withdraw = new UserWithdraw();
                    $withdraw['user_id'] = $user['id'];
                    $withdraw['sum']  = $request['sum'];
                    $withdraw['phone'] = $request['phone'];
                    $withdraw['status'] = 'waiting';
                    $withdraw->save();
                    return back()->with('message','Операция прошла успешно');

            }else{
                    return back()->withErrors('Недостаточно средств');
            }













        }
    }
    public function AccountCreate(Request $request){



        $rules = [
            'password'=>'required|max:255'
        ];
        $messages = [

            "password.required" => "Введите пароль для вашего аккаунта",
            "password.max" => "Допустимое количество символов 255"
        ];
        $validator = $this->validator($request->all(), $rules, $messages);
        if ($validator->fails()){
            return back()->withErrors($validator->errors());

        }else{
            $user = session()->get('user');
            $user = User::where('id', $user['id'])->first();
            if ($user['balance']<12000){
                return back()->withErrors('У вас недостаточно средств');
            }else {
                if ($request['referBy']) {
                    $userCellSum =  UserCell::whereUserId($request['referBy'])->sum('max_cell_count');
                    $userCount = User::where('referBy',$request['referBy'])->count();

                    if ($userCellSum <= $userCount){
                        return back()->withErrors('Нет пустой ячейки');
                    }
                    $userCell = UserCell::whereStatus(0)->whereUserId($request['referBy'])->where('cell_count', '<', 2)->orderBy('cell_count', 'desc')->first();

                    if (!$userCell) {
                        return back()->withErrors('Ошибка');
                    }

                    $user['balance'] = $user['balance'] - 12000;
                    $user->save();
                    $account = new User;

                    $account['login'] = $user['login'] . '_bot_' . $account['id'];
                    $account['name'] = $user['login'] . '_bot_' . $account['id'];


                    $account['phone'] = $user['phone'];
                    $account['email'] = $user['email'];
                    $account['password'] = $request['password'];
                    $account['balance'] = 0;

                    $account['accountBy'] = $user['id'];
                    $account->save();
                    $account['referBy'] = $request['referBy'];
                    $account['name'] = $user['name'] . '_account_' . $account['id'];
                    $account['login'] = $account['id'];
                    $account->save();

                    $userAcc = User::where('id', $request['referBy'])->first();

                    $ubo = new UserBalanceOperation;
                    $ubo->user_id = $user['id'];
                    $ubo->operation = 'purchase';
                    $ubo->sum = 12000;
                    $ubo->text = 'Покупка аккаунта';
                    $ubo->save();
                    $userCellRefer = new UserCellRefer();
                    $userCellRefer->user_cell_id = $userCell->id;
                    $userCellRefer->user_id = $user->id;
                    $userCellRefer->save();
                    $userCell->cell_count = UserCellRefer::whereUserCellId($userCell->id)->count();
                    $userCell->save();
                    $userCell = new UserCell();
                    $userCell->user_id = $account['id'];
                    $userCell->save();





                    $this->CellSum($request['referBy']);


                }else {
                    $user['balance'] = $user['balance'] - 12000;
                    $user->save();
                    $account = new User;
                    $a = 1;
                    $account['login'] = $user['login'] . '_bot_' . $account['id'];
                    $account['name'] = $user['login'] . '_bot_' . $account['id'];


                    $account['phone'] = $user['phone'];
                    $account['email'] = $user['email'];
                    $account['password'] = $request['password'];
                    $account['balance'] = 0;

                    $account['accountBy'] = $user['id'];
                    $account->save();

                    $account['name'] = $user['name'] . '_account_' . $account['id'];
                    $account['login'] = $account['id'];
                    $account->save();
                    $userCell = new UserCell();
                    $userCell->user_id = $account['id'];
                    $userCell->save();
                    $ubo = new UserBalanceOperation;
                    $ubo->user_id = $user['id'];
                    $ubo->operation = 'purchase';
                    $ubo->sum = 12000;
                    $ubo->text = 'Покупка аккаунта';
                    $ubo->save();
                }
                return redirect()->route('home')->with('message','Аккаунт создан');
            }




        }

    }

    protected function CellSum($user_id){
        $cells = UserCell::whereUserId($user_id)->where('cell_count',2)->where('status',0)->get();
        $user = User::findOrFail($user_id);
        $userAcc = User::find($user['accountBy']);
        if ($userAcc){
            $user = $userAcc;
            foreach($cells as $cell){
                $cell->status = 1;
                $cell->save();

                $user->balance = $user->balance + 17000;
                $user->save();

                $ubo = new UserBalanceOperation();
                $ubo->user_id = $user['id'];
                $ubo->operation = 'referer';
                $ubo->sum = 17000;
                $ubo->text = 'Бонусная система от второго аккаунта';
                $ubo->save();

            }
        }else{
            foreach($cells as $cell){
                $cell->status = 1;
                $cell->save();

                $user->balance = $user->balance + 17000;
                $user->save();

                $ubo = new UserBalanceOperation();
                $ubo->user_id = $user_id;
                $ubo->operation = 'referer';
                $ubo->sum = 17000;
                $ubo->text = 'Бонусная система';
                $ubo->save();

            }
        }
    }
}
