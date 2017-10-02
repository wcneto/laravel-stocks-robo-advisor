<?php namespace App\Http\Controllers;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use App\Repositories\ImageRepository;
use Validator;
use Input;
use File;
use Illuminate\Foundation\Validation\ValidatesRequests;
use \Eventviva\ImageResize;

class PageController extends Controller {
	/**
	 * The BlogRepository instance.
	 *
	 * @var App\Repositories\BlogRepository
	 */
	protected $image_gestion;

	/**
	 * Create a new PageController instance.
	 *
	 * @param  App\Repositories\ImageRepository $image_gestion
	 * @return void
	*/
	public function __construct(ImageRepository $image_gestion)
	{
		$this->image_gestion = $image_gestion;
	}

    public function adminPage()
    {
        $images = $this->image_gestion->search();
        
        return view('pages.admin', array('images' => $images, 'page_title' =>   'List Page'));
    }

	public function frontPage()
	{
		return view('pages.front', array('page_title' => "Upload Page"));
	}

	
    public function postImage(Request $request)
	{
	    $validator = Validator::make($request->all(), [
            'height' => 'integer',
            'width' => 'integer',
            'image_file'	=>	'required|image|mimes:png,jpg,jpeg,gif,bmp'
        ]);

        if ($validator->fails()) {
            return redirect('/')
                        ->withErrors($validator)
                        ->withInput();
        }
		
		// if pass validation
		$image_name = $request->file('image_file')->getClientOriginalName(); 
		$image_extension = $request->file('image_file')->getClientOriginalExtension();

		$image_new_name = md5(microtime(true));
		$temp_file = base_path() . '/public/images/upload/'.strtolower($image_new_name . '_temp.' . $image_extension);

		$request->file('image_file')
			->move( base_path() . '/public/images/upload/', strtolower($image_new_name . '_temp.' . $image_extension) );

        $origin_size = getimagesize( $temp_file );
        $origin_width = $origin_size[0];
        $origin_height = $origin_size[1];

        // resize
        $image_resize = new ImageResize($temp_file );

        if( trim( $request->get('height') ) != "")
        {
        	$height = $request->get('height');

        	
        }
        else
        {
			$height = 0;        	
        }

        if( trim( $request->get('width') ) != "")
        {
        	$width = $request->get('width');
        	
        }
        else
        {
        	$width = 0;
        }

        if($width > 0 && $height > 0)
        {
        	$image_resize->resize($width, $height);	
        }
        else if($width == 0 && $height > 0)
        {
        	$image_resize->resizeToHeight($height);
        }
        else if($width > 0 && $height == 0) 
        {
        	$image_resize->resizeToWidth($width);
        }
        $image_resize->save( base_path() . '/public/images/upload/' . $image_new_name . '.' . $image_extension );
        $image_location = '/images/upload/' . $image_new_name . '.' . $image_extension;

        File::delete($temp_file);

        $image_data = array(
        	'image_name'	=>	$image_name
        	,'image_extension'	=>	$image_extension
        	,'image_location'	=>	$image_location
        	,'origin_height'	=>	$origin_height
        	,'origin_width'		=>	$origin_width
        	,'height'			=>	$height
        	,'width'			=>	$width
        );

        $this->image_gestion->saveImage($image_data);

        return redirect('/')->with('message', 'Successfully upload image!');
	}	

}