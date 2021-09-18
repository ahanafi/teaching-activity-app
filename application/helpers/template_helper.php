<?php
if (!function_exists('showBtnLink')) {
	function showBtnLink($link, $colors, $textOrIcon, $isBtnIcon = false, $attributes = array())
	{
		$link = ($link !== '#') ? base_url($link) : $link;
		$btnClass = "btn btn-$colors";
		if ($isBtnIcon) {
			$btnClass .= " btn-icons";
			$textOrIcon = "<i class='fa fa-$textOrIcon'></i>";
		}

		$attribute = "";
		if (!empty($attributes)) {
			if (count($attributes) === 1) {
				$attributeName = array_keys($attributes)[0];
				$value = array_values($attributes)[0];

				$attribute = "$attributeName='$value'";
			} else if (count($attributes) > 1) {
				foreach ($attributes as $attributeName => $val) {
					$attribute .= "$attributeName='$val' ";
				}
			}
		}

		return "<a href='$link' class='$btnClass' $attribute>$textOrIcon</a> ";
	}
}
