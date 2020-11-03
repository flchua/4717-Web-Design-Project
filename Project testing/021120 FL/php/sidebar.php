<?php
include "dbconnect.php";


$sql = "SELECT * FROM `products`";
$result = $conn->query($sql);
?>


<!DOCTYPE html>
<html lang="en">
<section class="sidebar">
		<div class="u-m-medium--bottom">
			<h2 class="header">Narrow your search</h2>
		</div>
		<div id="option--tag" class="option-group">
			<?php
//				$tag = array('popular'   => 'Popular',
//				             'new'       => 'New',
//				             'promotion' => 'Promotion');
                $tag = array('discount' => 'Promotions');
				foreach($tag as $tag => $tag_string) {
					echo '
						<label for="tag--' . $tag . '" class="label label--checkbox">
							<input type="checkbox" name="tag[]" value="' . $tag_string . '" class="input--checkbox" id="tag--' . $tag . '"' .
                            (in_array($tag_string, $_GET["tag"]) ? ' checked' : '') .'>
							' . $tag_string . '
						</label>
					';
				}
			?>
		</div>
		<br>
		<div id="option--gender" class="option-group">

			<?php
				$cate = array('set'   => 'SET MENU',
				                'sashimi' => 'SASHIMI',
								'sushi'  => 'SUSHI',
								'beverage' => 'BEVERAGES');
				foreach($cate as $cate => $cate_string) {
					echo '
						<label for="cate--' . $cate . '" class="label label--checkbox"><br>
							<input type="checkbox" name="cate[]" value="' . $cate_string[0] . '" class="input--checkbox" id="cate--' . $cate . '" ' .
                        (in_array($cate_string[0], $_GET["cate"]) ? ' checked' : '') . ' onchange="toggleGender(this)">
							' . $cate_string . '
						</label>
					';
				}
			?>
		</div>
		<br><br>
		
	
		<button type="submit" class="button button--primary option__button">
			Apply Filters
		</button>
		<button type="reset" class="button button--secondary option__button">
			Clear All
		</button>
</section>
<script type='text/javascript' src='./js/global.js'></script>
