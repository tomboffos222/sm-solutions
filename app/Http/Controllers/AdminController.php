<?php

namespace App\Http\Controllers;
use App\Cat;
use App\Course;
use App\CourseVideo;
use App\Message;
use App\Payment;
use App\User;
use App\UserBalanceOperation;
use App\UserCell;
use App\UserCellRefer;
use App\UserWithdraw;
use Illuminate\Http\Request;
use App\Admin;

class AdminController extends Controller
{
    public function Admin(){
        return view('admin');
    }
    public function AdminLogin(Request $request)
    {

        $admin = Admin::where('login', $request['login'])->first();
        if ($admin) {
            if ($admin['password'] == $request['password']) {
                session()->put('admin', $admin);
                $admin = session()->get('admin');

                $data['admin'] = Admin::where('id', $admin['id'])->first();

                return redirect()->route('admin.Home')->with('message','Вы вошли');
            } else {
                return back()->withErrors('Вы ввели неправильный логин или пароль');
            }
        } else {
            return back()->withErrors('Вы ввели неправильный логин или пароль');


        }
    }
    public function Courses(){
        $data['admin'] = session()->get('admin');
        $data['courses'] = Course::join('course_videos','courses.id','=','course_videos.course_id')->select('courses.*','url')->orderBy('created_at','desc')->paginate(6);

        $data['cats'] = Cat::get();

        return view('admin.courses',$data);
    }
    public function CreateCourse(Request $request){
        $rules = [
            'video' => 'required|mimes:m4v,avi,flv,mp4,mov',
            'title' => 'required|max:255',
            'description' => 'required',

            'cat' => 'required'
        ];
        $messages = [
            "video.required" => "Загрузите видео",
            "video.mimes"  => "Формат видео должен быть mp4,flv,mp4,mp4v",
            "title.required" => "Введите название видео",
            "description"  => "Введите описание видео",

            "cat" => "Выберите категорию для видео"
        ];
        $validator = $this->validator($request->all(),$rules, $messages);
        if ($validator->fails()){
            return back()->withErrors($validator->errors());
        }else{
            if($request->hasFile('video')) {
                $video = $request['video'];
                $videoName = $video->getClientOriginalName();
                $path = public_path() . '/uploads/';
                $video->move($path,$videoName);
                $course = new Course;
                $course['title'] = $request['title'];
                $course['description'] = $request['description'];
                $course['cat_id'] = $request['cat'];
                $course->save();
                $course_video = new CourseVideo();
                $course_video['title'] = $request['title'];
                $course_video['course_id'] = $course['id'];
                $course_video['url'] = '/uploads/'.$videoName;
                $course_video->save();
                return redirect()->route('admin.Courses')->with('message','Добавлено');
            }
        }

    }
    public function UserAccept($id){
        $user = User::find($id);


        $user['status'] = 'partner';
        $user->save();

        if ($user['referBy']){
            $userCell = UserCell::whereStatus(0)->whereUserId($user['referBy'])->where('cell_count','<',2)->orderBy('cell_count','desc')->first();
            if (!$userCell) {
                return back('Ошибка');
            }

            $userCellRefer = new UserCellRefer();
            $userCellRefer->user_cell_id = $userCell->id;
            $userCellRefer->user_id = $user->id;
            $userCellRefer->save();


            $userCell->cell_count = UserCellRefer::whereUserCellId($userCell->id)->count();
            $userCell->save();
            $userAcc = User::where('id',$user['referBy'])->first();


            $this->CellSum($user['referBy']);




        }

        return back()->with('message','Процесс прошел успешно');
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
    public function Users(){


        $admin = session()->get('admin');
        $data['admin'] = Admin::where('id', $admin['id'])->first();
        $data['users'] = User::where('accountBy',null)->paginate(12);
        return view('admin.users',$data);
    }
    public function User($id){
        $admin = session()->get('admin');
        $data['admin'] = Admin::where('id', $admin['id'])->first();
        $user = User::find($id);
        $data['user'] = User::find($id);
        $data['accounts'] = User::where('accountBy',$user['id'])->paginate(12);
        $data['refers'] = User::where('referBy',$user['id'])->paginate(12);
        return view('admin.user',$data);
    }
    public function Home(){
        $admin = session()->get('admin');
        $data['admin'] = Admin::where('id', $admin['id'])->first();
        $data['courses'] = Course::count();
        $data['cats']  = Cat::count();
        $data['online'] = User::where('accountBy',null)->count();
        $data['balance'] = Payment::where('status','ok')->sum('sum');



        return view('admin.home',$data);
    }
    public function Withdraws(){
        $admin = session()->get('admin');
        $data['admin'] =  Admin::find($admin['id']);
        $data['withdraws'] = UserWithdraw::paginate(12);

        return view('admin.withdraws',$data);

    }
    public function AcceptWithdraw($id){
        $withdraw = UserWithdraw::find($id);
        $withdraw['status']  = 'ok';
        $withdraw->save();
        return back()->with('message','Операция прошла успешно');
    }
    public function Answer(){
        $data['admin'] = session()->get('admin');
        $data['questions'] = Message::where('answer','=','0')->orderBy('id','desc')->paginate(12);
        $data['answered'] = Message::where('answer','!=','0')->orderBy('id','desc')->paginate(12);



        return view('admin.answers',$data);
    }
    public function AnswerCreate(Request $request){
        $rules = [
          'question_id' => 'required',
          'answer' => 'required|max:1000',

        ];
        $messages = [
          'question_id.required' => 'Это сообщение является не действительным',
          'answer.required' => 'Введите ответ',
          'answer.max' =>  'Ответ не должен превышать 1000 символов',
        ];
        $validator = $this->validator($request->all(),$rules, $messages);
        if ($validator->fails()){
            return back()->withErrors($validator->errors());

        }else{
            $message = Message::find($request['question_id']);
            $message['answer']  = $request['answer'];
            $message->save();
            return back()->with('message','Ответ добавлен');
        }
    }
    public function CreateCat(Request $request){
        $rules = [
            'title'=>'required|max:255',
            'type'=>'required'

        ];
        $messages = [
          "title.required" => "Введите название"
        ];
        $validator = $this->validator($request->all(),$rules, $messages);
        if ($validator->fails()){
            return back()->withErrors($validator->errors());

        }else{
            $cat = new Cat();
            $cat['name'] = $request['title'];
            $cat['type'] = $request['type'];
            $cat->save();
            return back()->with('message','Добавлена новая категория');
        }
    }
}
