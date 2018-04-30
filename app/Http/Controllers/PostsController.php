<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;  
use App\Post;
use DB;  //  for testing 
use App\User;

class PostsController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // make it so you have to be logged in to create a new post, EXCEPT FOR THE POSTS PAGE WHERE YOU CAN SEE ALL
        //$this->middleware('auth', ['except' => ['index', 'show']]);

        // CAN SEE ONLY POSTS A SPECIFIC USER MADE
        $this->middleware('auth');

    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        $posts = Post::orderBy('created_at', 'desc')->paginate(10); // shows PAGES [1][2][...] at bottom, SORTS BY created_at

        return view('posts.index')->with('posts', $posts);     // return the view in the "posts" folder, "index.php" file

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create'); // under the 'posts' folder, return view of the template 'create'
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // USED TINKER HERE
        $this->validate($request, 
        [
            'title' => 'required',
            'author' => 'required',
            'publication_date' => 'required',
            'cover_image' => 'image|nullable|max:1999'  // make the file have to be an image file (jpg,png,etc)
                                                        // also under 2MB
        ]);

        //Handle File Upload
        if($request->hasFile('cover_image'))
        {
            // Get filename with the extension 
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            
            // Get just filename 
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

            // Get just extension 
            $extension = $request->file('cover_image')->getClientOriginalExtension();

            // Filename to store, the time() function is to make filename unique
            $fileNameToStore = $filename.'_'.time().'.'.$extension;

            // Upload Image, this goes to stroage,app,public,...
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
        }
        else
        {
            // DEFAULT IMAGE, IF NO IMAGE IS CHOSEN
            $fileNameToStore = 'noimage.jpg';
        }

        //Create Post
        $post = new Post;
        $post->title = $request->input('title');
        $post->author = $request->input('author');
        $post->publication_date = $request->input('publication_date');

        // $post->body =  $request->input('body'); just used for testing

        // user_id is used for authenication 
        $post->user_id = auth()->user()->id;
        $post->cover_image = $fileNameToStore;
        $post->save();

        return redirect('/posts')->with('success', 'Book Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // TO FETCH THE DATA FROM THE DATABASE
       // return Post::find($id);     // THIS WILL RETURN ALL DATA ON THE ASSOCIATED ID IN AN ARRAY, 
                                    // THIS WORKS WITH THE USE OF ELOQUENT

        $post = POST::find($id);
        return view('posts.show')->with('post', $post);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = POST::find($id);

        // Check for correct user, only if that user created that post can it have resource functions called on it
        if(auth()->user()->id !==$post->user_id)
        {
            return redirect('/posts')->with('error', 'You Are Unauthorized To Access This Page');
        }

        return view('posts.edit')->with('post', $post);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         // USED TINKER HERE
         $this->validate($request, 
         [
             // These fields are required
             'title' => 'required',
             'author' => 'required',
             'publication_date' => 'required'
             //'body' => 'required'
         ]);
 
          //Handle File Upload
          if($request->hasFile('cover_image'))
          {
              // Get filename with the extension 
              $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
              
              // Get just filename 
              $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
  
              // Get just extension 
              $extension = $request->file('cover_image')->getClientOriginalExtension();
  
              // Filename to store, the time() function is to make filename unique
              $fileNameToStore = $filename.'_'.time().'.'.$extension;
  
              // Upload Image, this goes to stroage,app,public,...
              $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
          }

         //Create Post
         $post = Post::find($id);
         $post->title = $request->input('title');
         //$post->body =  $request->input('body');
         $post->author = $request->input('author');
         $post->publication_date = $request->input('publication_date');

         if($request->hasFile('cover_image'))
         {
             $post->cover_image = $fileNameToStore;
         }

         $post->save();
 
         //return redirect('/posts')->with('success', 'Post Updated'); // THIS TAKES YOU TO THE PAGE WHERE YOU CAN SEE ALL POSTS
         return redirect('/home')->with('success', 'Book Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);

        if(auth()->user()->id !==$post->user_id)
        {
            return redirect('/posts')->with('error', 'Unauthorized Page');
        }

        // dont want the no image to disappear, use for later
        if($post->cover_image != 'noimage.jpg')
        {
            // Delete Image
            Storage::delete('public/cover_images/'.$post->cover_image);
        }

        $post->delete();
        return redirect('/posts')->with('success', 'Book Removed');
    }
}
