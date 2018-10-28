<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{Category, Post};

class PostController extends Controller
{
    public function index(Category $category = null, Request $request)
    {
        $routeName = $request->route()->getName();

        list($orderColumn, $orderDirection) = $this->getListOrder($request->get('orden'));

        $posts = Post::query()
            ->scopes($this->getListScopes($category, $routeName))
            ->orderBy($orderColumn, $orderDirection)
            ->paginate();

        $posts->appends(request()->intersect(['orden']));
        
        $categoryItems = $this->getCategoryItems();

        return view('posts.index', compact('posts', 'category', 'categoryItems'));
    }
    
    public function show(Post $post, $slug)
    {
        if ($post->slug != $slug) {
            return redirect($post->url, 301);
        }

        return view('posts.show', compact('post'));
    }

    protected function getCategoryItems()
    {
        return Category::orderBy('name')->get()->map(function ($category) {
            return [
                'title' => $category->name,
                'full_url' => route('posts.index', $category)
            ];
        })->toArray();
    }

    protected function getListScopes(Category $category, string $routeName)
    {
        $scopes = [];

        if ($category->exists) {
            $scopes['category'] = [$category];
        }
        
        if ($routeName == 'posts.pending') {
            $scopes[] = 'pending';
        }

        if ($routeName == 'posts.completed') {
            $scopes[] = 'completed';
        }

        return $scopes;
    }

    protected function getListOrder($order)
    {
        if ($order == 'recientes') {
            return ['created_at', 'desc'];
        }

        if ($order == 'antiguos') {
            return ['created_at', 'asc'];
        }

        return ['created_at', 'desc'];
    }
}
