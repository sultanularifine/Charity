<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BlogImage;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::all();
        return view('backend.blog.index', ['blogs' => $blogs]);
    }

    public function create()
    {
        return view('backend.blog.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image.*' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'blog_date' => 'required|string',
        ]);

        $blog = new Blog();
        $blog->title = $request->title;
        $blog->sub_title = $request->sub_title;
        $blog->description = $request->description;
        $blog->blog_date = $request->blog_date;
        if ($request->hasFile('thumbnail')) {
            $thumbnailFile = $request->file('thumbnail');
            $thumbnailPath = time() . '_' . $thumbnailFile->getClientOriginalName();
            $thumbnailFile->move(public_path('backend/thumbnails'), $thumbnailPath);
            $blog->thumbnail = 'thumbnails/' . $thumbnailPath;
        }
        if ($blog->save()) {
            if ($request->hasFile('image')) {
                foreach ($request->file('image') as $image) {
                    $blogImage = new BlogImage();
                    $blogImage->blog_id = $blog->id;
                    $imagepath = time() . '_' . $image->getClientOriginalName();
                    $image->move(public_path('backend/image'), $imagepath);
                    $blogImage->image = 'images/' . $imagepath;
                    $blogImage->save();
                }
            }
            return redirect()->route('blog.create')->with('success', 'Blog created successfully.');
        }
        return redirect()->route('blog.create')->with('error', 'Failed to create blog.');
    }

    public function show($id)
    {
        $blogs = Blog::with(['blogImage'])->find($id);
        return view('backend.blog.view', ['blogs' => $blogs]);
    }

    public function edit($id)
    {
        $blogs = Blog::find($id);
        return view('backend.blog.edit', ['blogs' => $blogs]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image.*' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'blog_date' => 'required|string',
        ]);

        $blog = Blog::find($id);
        $blog->title = $request->title;
        $blog->sub_title = $request->sub_title;
        $blog->description = $request->description;
        $blog->blog_date = $request->blog_date;

        if ($request->hasFile('thumbnail')) {
            if ($blog->thumbnail) {
                $oldThumbnailPath = public_path($blog->thumbnail);
                if (file_exists($oldThumbnailPath)) {
                    unlink($oldThumbnailPath);
                }
            }
            $thumbnailFile = $request->file('thumbnail');
            $thumbnailPath = time() . '_' . $thumbnailFile->getClientOriginalName();
            $thumbnailFile->move(public_path('backend/thumbnails'), $thumbnailPath);
            $blog->thumbnail = 'thumbnails/' . $thumbnailPath;
        }

        if ($blog->save()) {
            if ($request->hasFile('image')) {
                $blogimage = BlogImage::where('blog_id', $blog->id)->get();
                foreach ($blogimage as $row) {
                    if ($row->delete()) {
                        if ($row->image) {
                            $oldImagePath = public_path($row->image);
                            if (file_exists($oldImagePath)) {
                                unlink($oldImagePath);
                            }
                        }
                    }
                }
                foreach ($request->file('image') as $image) {
                    $blogImage = new BlogImage();
                    $blogImage->blog_id = $blog->id;
                    $imagepath = time() . '_' . $image->getClientOriginalName();
                    $image->move(public_path('backend/images'), $imagepath);
                    $blogImage->image = 'images/' . $imagepath;
                    $blogImage->save();
                }
            }
            return redirect()->route('blog.list')->with('success', 'Blog updated successfully.');
        }
        return redirect()->route('blog.edit', $id)->with('error', 'Failed to update blog.');
    }

    public function destroy($id)
    {
        $blog = Blog::find($id);
        if ($blog->delete()) {
            return redirect()->route('blog.list');
        }
    }
}
