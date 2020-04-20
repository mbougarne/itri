<?php

/**
 * Controller Template Method class, to share some repetitive functionalities with all controllers:
 * StoreImage to store images from request
 * validateRequest validate request inputs
 * sendResponse redirect the request to correspondence route name
 */

namespace App\Http\Controllers\Lib;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ControllerMethod
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Store images functionality
     *
     * @param string $file_name Request input file name
     * @param string $path name to where to store the file
     * @param string $disk name to use for storage
     * @return string $image_name stored image name
     */
    public function storeImage(
        string $file_name,
        string $path = 'thumbnails',
        string $disk = 'uploads') : string
    {

        $extension = $this->request->file($file_name)->extension();

        $image_name = md5(Str::random() . time()) . '.' . $extension;

        $this->request->file($file_name)->storeAs($path, $image_name, $disk);

        return $image_name;
    }

    /**
     * Validate incoming request and return its data
     *
     * @param array $rules request inputs validation rules
     * @param string $file_name request image input
     * @param string $path_name storage path name
     * @param string $storage_disk storage disk name
     * @return array
     */
    public function validateRequest(
        array $rules,
        string $file_name = null,
        string $path_name = 'thumbnails',
        string $storage_disk = 'uploads'
    ) : array
    {

        $data = $this->request->validate($rules);

        if($this->request->hasFile($file_name))
        {
            $thumbnail = $this->storeImage($file_name, $path_name, $storage_disk);
            $data = array_merge($data, [$file_name => $thumbnail]);
        }

        return $data;
    }

    /**
     * Redirect to corresponding web route
     *
     * @param boolean|array $process_status model operation status
     * @param string $route_name
     * @param string $success_message
     * @param string $error_message
     * @return \Illuminate\Http\Response
     */
    public function sendResponse(
        $process_status,
        string $route_name,
        string $success_message = '',
        string $error_message = '')
    {
        // Success redirect
        if($process_status)
        {
            return redirect()
                    ->route($route_name)
                    ->with('success', $success_message);
        }
        // Error redirect
        return redirect()
                ->back()
                ->withErrors(['errors' => $error_message]);
    }
}
