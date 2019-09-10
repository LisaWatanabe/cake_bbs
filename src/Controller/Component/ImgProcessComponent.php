<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;

class ImgProcessComponent extends Component {
	function initialize(array $config) {
		$this->controller = $this->_registry->getController();
	}
	function save($request) {
		$img = $request->data['img'];
		$ext = pathinfo($img['name'], PATHINFO_EXTENSION);
		$name = md5(uniqid(rand(),1)).'.'.$ext;
		$request->data['img_ext'] = $ext;
		$request->data['img_size'] = $img['size'];
		$request->data['img_name'] = $name;
	}
	function generate($tmp_name, $post) {
		move_uploaded_file($tmp_name, 'img/'.$post->img_name);
		$original_file = 'img/'.$post->img_name;
		list($original_width, $original_height) = getimagesize($original_file);
		$thumb_width = 300;
		$thumb_height = round($original_height * $thumb_width / $original_width);
		if ($post->img_ext === 'jpg') $original_image = imagecreatefromjpeg($original_file);
		if ($post->img_ext === 'png') $original_image = imagecreatefrompng($original_file);
		if ($post->img_ext === 'gif') $original_image = imagecreatefromgif($original_file);
		$thumb_image = imagecreatetruecolor($thumb_width, $thumb_height);
		imagecopyresized($thumb_image, $original_image, 0, 0, 0, 0, $thumb_width, $thumb_height, $original_width, $original_height);
		if ($post->img_ext === 'jpg') imagejpeg($thumb_image, 'img/mini/'.$post->img_name);
		if ($post->img_ext === 'png') imagepng($thumb_image, 'img/mini/'.$post->img_name);
		if ($post->img_ext === 'gif') imagegif($thumb_image, 'img/mini/'.$post->img_name);
	}
}













 ?>