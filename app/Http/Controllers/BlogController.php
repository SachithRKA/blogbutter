<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use ButterCMS\ButterCMS;

class BlogController extends Controller
{
    public function home() {
        $butterClient = new ButterCMS(env('BUTTER_API_KEY'));
        $postsResponse = $butterClient->fetchPosts();

        return view('home', ['posts' => $postsResponse->getPosts()]);
    }

    public function showPost (Request $request, $slug){
        $butterClient = new ButterCMS(env('BUTTER_API_KEY'));

        try {
            $postResponse = $butterClient->fetchPost($slug);
        }
        catch (RequestException $error) {
            return redirect('/');
        }
        
        return view('post', ['post' => $postResponse->getPost()]);
    }

    public function sendNotification (request $request) {
        $butterClient = new ButterCMS(env('BUTTER_API_KEY'));
        $slug = $request->get('data')['id'];
        $postResponse = $butterClient->fetchPost($slug);
        $users = User::all();

        if ($users->count()) {
            Notification::sendNow($users, new NewPost($postResponse->getPost()->getTitle(), route('post', ['slug' => $postResponse->getPost()->getSlud()])));
        }
    }
}