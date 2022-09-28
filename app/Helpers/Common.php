<?php
// get current user name
if (!function_exists('user')) {
    function user()
    {
        return Auth::user();
    }
}
if (!function_exists('image')) {
    function image($request)
    {
        $file = $request->file('image');
        $extension = $file->getClientOriginalExtension();
        $filename = time() . '.' . $extension;
        $file->move('public/documents/', $filename);
        $image = $filename;

        return $image;
    }
}
