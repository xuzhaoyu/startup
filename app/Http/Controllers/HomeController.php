<?php namespace App\Http\Controllers;
use DB;
use Form;
use Input;
class HomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
        /**
         * Find all ideas not written by the current logged in user and pass it to the page
         */
        $email = \Auth::user()->email;
        $ideas = DB::table('ideas')->select('*')->where('email', '<>', $email)->get();
		return view('/home')->with('ideas', $ideas);
	}

    public function getIdea(){
        /**
         * Return the page where the user post his or her idea
         */
        return view('postIdea');
    }

    public function getMyIdea(){
        /**
         * Find all ideas written by the current logged in user and pass it to the page
         */
        $email = \Auth::user()->email;
        $ideas = DB::table('ideas')->select('*')->where('email', '=', $email)->get();
        return view('myIdea')->with('ideas', $ideas);
    }

    public function getDelete($id){
        /**
         * Use the id from the idea table gotten from the selected idea to be deleted from the db
         * and return to the my idea page after delete
         */
        DB::table('ideas')
            -> where('id','=', $id)
            -> delete();
        $email = \Auth::user()->email;
        $ideas = DB::table('ideas')->select('*')->where('email', '=', $email)->get();
        return redirect('myIdea')->with('ideas', $ideas);
    }

    public function getSort($column){
        /**
         * Sort the others' idea page by whatever the current logged in user clicked to be sorted by
         */
        $email = \Auth::user()->email;
        if($column == 'name'){
            $ideas = DB::table('ideas')->select('*')->where('email', '<>', $email)->orderBy('name', 'asc')->get();
        } else if ($column == 'market'){
            $ideas = DB::table('ideas')->select('*')->where('email', '<>', $email)->orderBy('market', 'asc')->get();
        } else {
            $ideas = DB::table('ideas')->select('*')->where('email', '<>', $email)->orderBy('created', 'asc')->get();
        }
        return view('/home')->with('ideas', $ideas);
    }

    public function getDetails($id){
        /**
         * Returns the page of the selected idea details page
         */
        $idea = DB::table('ideas')->select('*')->where('id', '=', $id)->first();
        return view('details')->with('idea', $idea);
    }

    public function getLike($id){
        /**
         * Add or remove likes of the idea from the idea id
         * First checks if the current user already liked this idea
         * if he or she did, then it means dislike which this function will remove 1
         * like from this idea and remove an entry from the like table.
         * If the user didn't already like it, we add 1 like
         * to this idea and add an entry to the like table to keep track who
         * liked what
         */
        $email = \Auth::user()->email;
        $liked = DB::table('likes')->select('*')->where('ideaId','=',$id)->where('email', '=', $email)->get();
        if($liked){
            DB::table('likes')->where('ideaId','=',$id)->where('email', '=', $email)->delete();
            DB::table('ideas')->where('id', '=', $id)->decrement('like', 1);
        } else{
            DB::table('likes')
                -> insert(array(
                    'email' => $email,
                    'ideaId' => $id
                ));
            DB::table('ideas')->where('id', '=', $id)->increment('like', 1);
        }
        $ideas = DB::table('ideas')->select('*')->where('email', '<>', $email)->get();
        return view('/home')->with('ideas', $ideas);
    }

    public function getEdit($id){
        /**
         * Return the page where it allows the current logged in user
         * to edit the idea he or she just selected
         */
        $idea = DB::table('ideas')->select('*')->where('id', '=', $id)->first();
        return view('edit')->with('idea', $idea);
    }

    public function getGraph(){
        /**
         * Get all the counts of each market and pass it to the graph page
         */
        $health = count(DB::table('ideas')->where('market','=','Health')->get());
        $tech = count(DB::table('ideas')->where('market','=','Technology')->get());
        $finance = count(DB::table('ideas')->where('market','=','Finance')->get());
        $travel = count(DB::table('ideas')->where('market','=','Travel')->get());
        $edu = count(DB::table('ideas')->where('market','=','Education')->get());
        $counts = array('Health'=>$health, 'Technology'=>$tech, 'Finance'=>$finance, 'Travel'=>$travel, 'Education'=>$edu);
        return view('graph')->with('counts', $counts);
    }

    public function postEdit() {
        /**
         * Function that updates db with the new information the user just
         * gave from editing one of his or her idea and return to the my idea page
         */
        $input = Input::all();
        $tags = array_map('trim', explode(',', $input['keywords']));
        DB::table('ideas')->where('id','=',$input['id'])->update(array(
            'name' => $input['name'],
            'market' => $input['market'],
            'description' => $input['description'],
            'tags' => $input['keywords']
        ));
        $email = \Auth::user()->email;
        $ideas = DB::table('ideas')->select('*')->where('email', '=', $email)->get();
        return view('myIdea')->with('ideas', $ideas);
    }

    public function postIdea() {
        /**
         * Function that adds the new idea written by the user to the db
         * and returns to the all idea page
         */
        $input = Input::all();
        $tags = array_map('trim', explode(',', $input['keywords']));
        $date = date('Y-m-d');
        $email = \Auth::user()->email;
        DB::table('ideas')
            -> insert(array(
                'email' => $email,
                'username' => \Auth::user()->name,
                'name' => $input['name'],
                'market' => $input['market'],
                'description' => $input['description'],
                'like' => 0,
                'created' => $date,
                'tags' => $input['keywords']
            ));
        $ideas = DB::table('ideas')->select('*')->where('email', '=', $email)->get();
        return view('myIdea')->with('ideas', $ideas);
    }
}
