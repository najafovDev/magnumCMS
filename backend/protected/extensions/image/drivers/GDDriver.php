<?php Yii::import('application.extensions.image.ImageDriver');
/**
 * GD Image Driver.
 *
 * @package    Image
 * @copyright  (c) 2008-2009 Kohana Team
 * @license    http://kohanaphp.com/license.html
 */
class GDDriver extends ImageDriver {

	// Which GD functions are available?
	const IMAGEROTATE = 'imagerotate';
	const IMAGECONVOLUTION = 'imageconvolution';
	const IMAGEFILTER = 'imagefilter';
	const IMAGELAYEREFFECT = 'imagelayereffect';
	protected static $_available_functions = array();

	/**
	 * Checks if GD is enabled and verify that key methods exist, some of which require GD to
	 * be bundled with PHP.  Exceptions will be thrown from those methods when GD is not
	 * bundled.
	 *
	 * @return  boolean
	 */
	public static function check() {
		if ( ! function_exists('gd_info'))
			throw new CException(Yii::t('GD is either not installed or not enabled, check your configuration'));

		$functions = array(
			GDDriver::IMAGEROTATE,
			GDDriver::IMAGECONVOLUTION,
			GDDriver::IMAGEFILTER,
			GDDriver::IMAGELAYEREFFECT
		);

		foreach ($functions as $function)
			GDDriver::$_available_functions[$function] = function_exists($function);

		// Get the version via a constant, available in PHP 5.2.4+
		if (defined('GD_VERSION')) {

			$version = GD_VERSION;

		} else {
			// Get the version information
			$info = gd_info();

			// Extract the version number
			preg_match('/\d+\.\d+(?:\.\d+)?/', $info['GD Version'], $matches);

			// Get the major version
			$version = $matches[0];
		}

		if (!version_compare($version, '2.0.1', '>='))
			throw new CException(Yii::t(
				'GDDriver requires GD version {required} or greater, you have {version}',
				array('required' => '2.0.1', 'version' => $version)
			));

		return GDDriver::$_checked = TRUE;
	}

	// Temporary image resource
	protected $_image;

	// Function name to open Image
	protected $_create_function;

	/**
	 * Runs [GDDriver::check] and loads the image.
	 *
	 * @param   string  $file  image file path
	 * @return  void
	 * @throws  CException
	 */
	public function __construct($file) {

		if (!GDDriver::$_checked)
			// Run the install check
			GDDriver::check();

		$info = getimagesize($file);
		$this->width = $info[0];
		$this->height = $info[1];
		$this->type = $info[2];
		$this->mime = $info['mime'];
		$this->file = $file;

		// Set the image creation function name
		switch ($this->type) {
			case IMAGETYPE_JPEG:
				$create = 'imagecreatefromjpeg';
			break;
			case IMAGETYPE_GIF:
				$create = 'imagecreatefromgif';
			break;
			case IMAGETYPE_PNG:
				$create = 'imagecreatefrompng';
			break;
		}

		if (!isset($create) || !function_exists($create))
			throw new CException(Yii::t(
				'Installed GD does not support :type images',
				array(':type' => image_type_to_extension($this->type, FALSE))
			));

		// Save function for future use
		$this->_create_function = $create;

		// Save filename for lazy loading
		$this->_image = $this->file;
	}

	/**
	 * Destroys the loaded image to free up resources.
	 *
	 * @return  void
	 */
	public function __destruct() {
		if (is_resource($this->_image))
			imagedestroy($this->_image);
	}

	/**
	 * Loads an image into GD.
	 *
	 * @return  void
	 */
	protected function _load_image() {

		if (is_resource($this->_image))
			return;

		// Gets create function
		$create = $this->_create_function;

		// Open the temporary image
		$this->_image = $create($this->file);

		// Preserve transparency when saving
		imagesavealpha($this->_image, TRUE);
	}


	public function resize($width, $height) {

		// Presize width and height
		$pre_width = $this->width;
		$pre_height = $this->height;

		// Loads image if not yet loaded
		$this->_load_image();

		// Test if we can do a resize without resampling to speed up the final resize
		if ($width > ($this->width / 2) && $height > ($this->height / 2)) {

			// The maximum reduction is 10% greater than the final size
			$reduction_width  = round($width  * 1.1);
			$reduction_height = round($height * 1.1);

			while ($pre_width / 2 > $reduction_width && $pre_height / 2 > $reduction_height) {
				// Reduce the size using an O(2n) algorithm, until it reaches the maximum reduction
				$pre_width /= 2;
				$pre_height /= 2;
			}

			// Create the temporary image to copy to
			$image = $this->_create($pre_width, $pre_height);

			if (imagecopyresized($image, $this->_image, 0, 0, 0, 0, $pre_width, $pre_height, $this->width, $this->height)) {
				// Swap the new image for the old one
				imagedestroy($this->_image);
				$this->_image = $image;
			}
		}

		// Create the temporary image to copy to
		$image = $this->_create($width, $height);

		// Execute the resize
		if (imagecopyresampled($image, $this->_image, 0, 0, 0, 0, $width, $height, $pre_width, $pre_height)) {
			// Swap the new image for the old one
			imagedestroy($this->_image);
			$this->_image = $image;

			// Reset the width and height
			$this->width  = imagesx($image);
			$this->height = imagesy($image);

			return true;
		}

		return false;
	}


	public function crop($width, $height, $offset_x, $offset_y) {

		// Create the temporary image to copy to
		$image = $this->_create($width, $height);

		// Loads image if not yet loaded
		$this->_load_image();

		// Execute the crop
		if (imagecopyresampled($image, $this->_image, 0, 0, $offset_x, $offset_y, $width, $height, $width, $height)) {
			// Swap the new image for the old one
			imagedestroy($this->_image);
			$this->_image = $image;

			// Reset the width and height
			$this->width  = imagesx($image);
			$this->height = imagesy($image);

			return true;
		}

		return false;
	}


	public function rotate($degrees) {

		if (empty(GDDriver::$_available_functions[GDDriver::IMAGEROTATE]))
			throw new CException(Yii::t(
				'This method requires {function}, which is only available in the bundled version of GD',
				array('function' => 'imagerotate')
			));

		// Loads image if not yet loaded
		$this->_load_image();

		// Transparent black will be used as the background for the uncovered region
		$transparent = imagecolorallocatealpha($this->_image, 0, 0, 0, 127);

		// Rotate, setting the transparent color
		$image = imagerotate($this->_image, 360 - $degrees, $transparent, 1);

		// Save the alpha of the rotated image
		imagesavealpha($image, TRUE);

		// Get the width and height of the rotated image
		$width  = imagesx($image);
		$height = imagesy($image);

		if (imagecopymerge($this->_image, $image, 0, 0, 0, 0, $width, $height, 100)) {
			// Swap the new image for the old one
			imagedestroy($this->_image);
			$this->_image = $image;

			// Reset the width and height
			$this->width  = $width;
			$this->height = $height;

			return true;
		}

		return false;
	}


	public function flip($direction) {

		// Create the flipped image
		$flipped = $this->_create($this->width, $this->height);

		// Loads image if not yet loaded
		$this->_load_image();

		if ($direction === Image::HORIZONTAL)
			// Flip each row from top to bottom
			for ($x = 0; $x < $this->width; $x++)
				imagecopy($flipped, $this->_image, $x, 0, $this->width - $x - 1, 0, 1, $this->height);
		else
			// Flip each column from left to right
			for ($y = 0; $y < $this->height; $y++)
				imagecopy($flipped, $this->_image, 0, $y, 0, $this->height - $y - 1, $this->width, 1);

		// Swap the new image for the old one
		imagedestroy($this->_image);
		$this->_image = $flipped;

		// Reset the width and height
		$this->width  = imagesx($flipped);
		$this->height = imagesy($flipped);
	}


	public function sharpen($amount) {

		if (empty(GDDriver::$_available_functions[GDDriver::IMAGECONVOLUTION]))
			throw new CException(Yii::t(
				'This method requires {function}, which is only available in the bundled version of GD',
				array('function' => 'imageconvolution')
			));

		// Loads image if not yet loaded
		$this->_load_image();

		// Amount should be in the range of 18-10
		$amount = round(abs(-18 + ($amount * 0.08)), 2);

		// Gaussian blur matrix
		$matrix = array(
			array(-1,   -1,    -1),
			array(-1, $amount, -1),
			array(-1,   -1,    -1),
		);

		// Perform the sharpen
		if (imageconvolution($this->_image, $matrix, $amount - 8, 0)) {
			// Reset the width and height
			$this->width  = imagesx($this->_image);
			$this->height = imagesy($this->_image);
		}
	}


	public function reflection($height, $opacity, $fade_in) {

		if (empty(GDDriver::$_available_functions[GDDriver::IMAGEFILTER]))
			throw new CException(Yii::t(
				'This method requires {function}, which is only available in the bundled version of GD',
				array('function' => 'imagefilter')
			));

		// Loads image if not yet loaded
		$this->_load_image();

		// Convert an opacity range of 0-100 to 127-0
		$opacity = round(abs(($opacity * 127 / 100) - 127));

		if ($opacity < 127)
			// Calculate the opacity stepping
			$stepping = (127 - $opacity) / $height;
		else
			// Avoid a "divide by zero" error
			$stepping = 127 / $height;

		// Create the reflection image
		$reflection = $this->_create($this->width, $this->height + $height);

		// Copy the image to the reflection
		imagecopy($reflection, $this->_image, 0, 0, 0, 0, $this->width, $this->height);

		for ($offset = 0; $height >= $offset; $offset++) {

			// Read the next line down
			$src_y = $this->height - $offset - 1;

			// Place the line at the bottom of the reflection
			$dst_y = $this->height + $offset;

			if ($fade_in === TRUE)
				// Start with the most transparent line first
				$dst_opacity = round($opacity + ($stepping * ($height - $offset)));
			else
				// Start with the most opaque line first
				$dst_opacity = round($opacity + ($stepping * $offset));

			// Create a single line of the image
			$line = $this->_create($this->width, 1);

			// Copy a single line from the current image into the line
			imagecopy($line, $this->_image, 0, 0, 0, $src_y, $this->width, 1);

			// Colorize the line to add the correct alpha level
			imagefilter($line, IMG_FILTER_COLORIZE, 0, 0, 0, $dst_opacity);

			// Copy a the line into the reflection
			imagecopy($reflection, $line, 0, $dst_y, 0, 0, $this->width, 1);
		}

		// Swap the new image for the old one
		imagedestroy($this->_image);
		$this->_image = $reflection;

		// Reset the width and height
		$this->width  = imagesx($reflection);
		$this->height = imagesy($reflection);

		return true;
	}


	public function watermark(Image $watermark, $offset_x, $offset_y, $opacity) {

		if (empty(GDDriver::$_available_functions[GDDriver::IMAGELAYEREFFECT]))
			throw new CException(Yii::t(
				'This method requires {function}, which is only available in the bundled version of GD',
				array('function' => 'imagelayereffect')
			));

		// Loads image if not yet loaded
		$this->_load_image();

		// Create the watermark image resource
		$overlay = imagecreatefromstring($watermark->render());

		imagesavealpha($overlay, TRUE);

		// Get the width and height of the watermark
		$width  = imagesx($overlay);
		$height = imagesy($overlay);

		if ($opacity < 100) {
			// Convert an opacity range of 0-100 to 127-0
			$opacity = round(abs(($opacity * 127 / 100) - 127));

			// Allocate transparent gray
			$color = imagecolorallocatealpha($overlay, 127, 127, 127, $opacity);

			// The transparent image will overlay the watermark
			imagelayereffect($overlay, IMG_EFFECT_OVERLAY);

			// Fill the background with the transparent color
			imagefilledrectangle($overlay, 0, 0, $width, $height, $color);
		}

		// Alpha blending must be enabled on the background!
		imagealphablending($this->_image, TRUE);

		if (imagecopy($this->_image, $overlay, $offset_x, $offset_y, 0, 0, $width, $height))
			// Destroy the overlay image
			imagedestroy($overlay);
	}


	public function background($r, $g, $b, $opacity) {

		// Loads image if not yet loaded
		$this->_load_image();

		// Convert an opacity range of 0-100 to 127-0
		$opacity = round(abs(($opacity * 127 / 100) - 127));

		// Create a new background
		$background = $this->_create($this->width, $this->height);

		// Allocate the color
		$color = imagecolorallocatealpha($background, $r, $g, $b, $opacity);

		// Fill the image with white
		imagefilledrectangle($background, 0, 0, $this->width, $this->height, $color);

		// Alpha blending must be enabled on the background!
		imagealphablending($background, TRUE);

		// Copy the image onto a white background to remove all transparency
		if (imagecopy($background, $this->_image, 0, 0, 0, 0, $this->width, $this->height))
			// Swap the new image for the old one
			imagedestroy($this->_image);
			$this->_image = $background;
	}


	public function save($file, $quality) {

		// Loads image if not yet loaded
		$this->_load_image();

		// Get the extension of the file
		$extension = pathinfo($file, PATHINFO_EXTENSION);

		// Get the save function and IMAGETYPE
		list($save, $type) = $this->_save_function($extension, $quality);

		// Save the image to a file
		$status = isset($quality) ? $save($this->_image, $file, $quality) : $save($this->_image, $file);

		if ($status === TRUE && $type !== $this->type) {
			// Reset the image type and mime type
			$this->type = $type;
			$this->mime = image_type_to_mime_type($type);
		}

		return TRUE;
	}


	public function render($type, $quality) {
		// Loads image if not yet loaded
		$this->_load_image();

		// Get the save function and IMAGETYPE
		list($save, $type) = $this->_save_function($type, $quality);

		// Capture the output
		ob_start();

		// Render the image
		$status = isset($quality) ? $save($this->_image, NULL, $quality) : $save($this->_image, NULL);

		if ($status === TRUE && $type !== $this->type) {
			// Reset the image type and mime type
			$this->type = $type;
			$this->mime = image_type_to_mime_type($type);
		}

		return ob_get_clean();
	}


	public function getWidth() {
		return $this->width;
	}


	public function getHeight() {
		return $this->height;
	}

	/**
	 * Get the GD saving function and image type for this extension.
	 * Also normalizes the quality setting
	 *
	 * @param   string   $extension  image type: png, jpg, etc
	 * @param   integer  $quality    image quality
	 * @return  array    save function, IMAGETYPE_* constant
	 * @throws  CException
	 */
	protected function _save_function($extension, & $quality) {

		if (!$extension)
			// Use the current image type
			$extension = image_type_to_extension($this->type, FALSE);

		switch (strtolower($extension)) {
			case 'jpg':
			case 'jpeg':
				// Save a JPG file
				$save = 'imagejpeg';
				$type = IMAGETYPE_JPEG;
			break;
			case 'gif':
				// Save a GIF file
				$save = 'imagegif';
				$type = IMAGETYPE_GIF;

				// GIFs do not a quality setting
				$quality = NULL;
			break;
			case 'png':
				// Save a PNG file
				$save = 'imagepng';
				$type = IMAGETYPE_PNG;

				// Use a compression level of 9 (does not affect quality!)
				$quality = 9;
			break;
			default:
				throw new CException(Yii::t(
					'Installed GD does not support {type} images',
					array('type' => $extension)
				));
			break;
		}

		return array($save, $type);
	}

	/**
	 * Create an empty image with the given width and height.
	 *
	 * @param   integer   $width   image width
	 * @param   integer   $height  image height
	 * @return  resource
	 */
	protected function _create($width, $height) {
		// Create an empty image
		$image = imagecreatetruecolor($width, $height);

		// Do not apply alpha blending
		imagealphablending($image, FALSE);

		// Save alpha levels
		imagesavealpha($image, TRUE);

		return $image;
	}

}