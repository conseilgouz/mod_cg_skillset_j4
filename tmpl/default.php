<?php
/**
 * CG Skillset module for Joomla! 4.x/5.x
 * @copyright   Copyright (C) 2024 ConseilGouz. All rights reserved.
 * @license     GNU General Public License version 3 or later; see LICENSE
 * From JD SkillSet 1.7
 */

// No direct access
defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Uri\Uri;

$modulefield	= 'media/mod_cg_skillset/';
/** @var Joomla\CMS\WebAsset\WebAssetManager $wa */
$wa = Factory::getApplication()->getDocument()->getWebAssetManager();
$wa->registerAndUseStyle('cgskillset', $modulefield.'css/mod_cg_skillset.css');
$wa->registerAndUseStyle('cggrid', $modulefield.'css/cggrid.min.css');
if ((bool)Factory::getApplication()->getConfig()->get('debug')) { // Mode debug
    Factory::getApplication()->getDocument()->addScript(''.URI::base(true).'/'.$modulefield.'js/cg_skillset.js');
} else {
    $wa->registerAndUseScript('cgskillset', $modulefield.'js/cg_skillset.js');
}
$skillsets = $params->get('skillsets', []);
$numberPosition = $params->get('numberPosition', 'above');
$symbolPosition = $params->get('symbolPosition', 'default');
$numberColor = $params->get('numberColor', '');

$titleColor = $params->get('titleColor', '');
$numberColor = $params->get('numberColor', '');
$symbolColor = $params->get('symbolColor', '');
$iconColor = $params->get('iconColor', '');

$titleSize = $params->get('titleSize', 20);
$numberSize = $params->get('numberSize', 40);
$symbolSize = $params->get('symbolSize', 40);
$iconSize = $params->get('iconSize', 52);

$customsStyle = $params->get('customsStyle');
$animationShape = $params->get('animationShape', 0);
$animationShape = $params->get('animationShape', 0);

$i = sizeof((array) $skillsets);
$size = 12 / $i;

Factory::getApplication()->getDocument()->addScriptOptions(
    'cg_skillset_'.$module->id,
    array('id' => $module->id,'skillsets' => $i , 'customstyle' => $customsStyle,
    'titleSize' => $titleSize,'numberSize' => $numberSize,'symbolSize' => $symbolSize,
    'iconSize' => $iconSize,  'titleColor' => $titleColor, 'numberColor' => $numberColor,
    'symbolColor' => $symbolColor, 'iconColor' => $iconColor, 'animationShape' => $animationShape)
);

?>

<div id="cg_skillset<?php echo $module->id; ?>" data="<?php echo $module->id; ?>" class="cg_skillset cg-row counter-sub-container skillset-not-counted <?php if ($params->get('IconPosition') == 'left') {
    echo 'cg-icon-position-left';
} ?><?php if ($params->get('IconPosition') == 'right') {
    echo 'cg-icon-position-right';
} ?> ">
	<?php foreach ($skillsets as $index => $skillset) : ?>
		<div class="cg-col-12 cg-col-md-6 cg-col-lg-<?php echo $size; ?>" id="skillset-<?php echo $index; ?>-<?php echo $module->id; ?>">
			<div class="counter-wrapper">
				<?php if ($params->get('IconPosition') == 'top' or $params->get('IconPosition') == 'right' or $params->get('IconPosition') == 'left') { ?>
					<?php if ($skillset->skillset_icon_option == 'upload') { ?>
						<?php if (!empty($skillset->skillset_icon_upload)) { ?>
							<div class="counter-icon">
								<img src="<?php echo $skillset->skillset_icon_upload; ?>" alt="<?php echo strip_tags($skillset->skillset_title); ?>"></img>
							</div>
						<?php } ?>
					<?php } elseif ($skillset->skillset_icon_option == 'icon') { ?>
						<?php if (!empty($skillset->skillset_icon_icon)) { ?>
							<div class="counter-icon">
								<i class="<?php echo $skillset->skillset_icon_icon; ?> count-icon" alt="icon"></i>
							</div>
						<?php } ?>
					<?php } ?>
				<?php } ?>
				<?php if (!empty($skillset->skillset_title) or !empty($skillset->skillset_number)) { ?>
                <?php if ($params->get('animationShape', 0)) {
                    echo "<div class='circular-progress' data-id='".$module->id."' data-progress-color='".$params->get("animationProgressColor", "#007eff")."' data-bg-color='".$params->get("animationStartColor", "#8ee58e")."'>";
                    echo "<div class='inner-circle' data-id='".$module->id."' data-inner-circle-color='".$params->get("animationBackground", "#d3d3d3")."'></div>";
                } ?>
					<div class="counter-text-container">
						<?php if ($numberPosition == 'above') { ?>
							<?php if (!empty($skillset->skillset_number)) { ?>
								<p class="counter-number">
									<span class="count" data-counter="<?php echo $skillset->skillset_number; ?>">0</span>
									<?php
                                    if (($skillset->skillset_enable_symbol)) { ?>
										<span>
											<?php $symbolTag = $symbolPosition == 'default' ? 'span' : $symbolPosition; ?>
											<<?php echo $symbolTag; ?> class="symbol">
												<?php echo $skillset->skillset_symbol; ?>
											</<?php echo $symbolTag; ?>>
										</span>
									<?php } ?>
								</p>
							<?php } ?>
						<?php } ?>
						<?php if (!empty($skillset->skillset_title)) { ?>
							<p class="counter-title"><?php echo $skillset->skillset_title; ?></p>
						<?php } ?>

						<?php if ($numberPosition == 'below') { ?>
							<?php if (!empty($skillset->skillset_number)) { ?>
								<p class="counter-number">
									<span class="count" data-counter="<?php echo $skillset->skillset_number; ?>">0</span>
									<?php
                                    if (($skillset->skillset_enable_symbol)) { ?>
										<span>
											<span>
												<?php $symbolTag = $symbolPosition == 'default' ? 'span' : $symbolPosition; ?>
												<<?php echo $symbolTag; ?> class="symbol">
													<?php echo $skillset->skillset_symbol; ?>
												</<?php echo $symbolTag; ?>>
											</span>
										</span>
									<?php } ?>
								</p>
							<?php } ?>
						<?php } ?>
						</div>
                 <?php if ($params->get('animationShape', 0)) {
                     echo "</div>";
                 } ?>
				<?php } ?>
				<?php if ($params->get('IconPosition') == 'bottom') { ?>
					<?php if ($skillset->skillset_icon_option == 'upload') { ?>
						<?php if (!empty($skillset->skillset_icon_upload)) { ?>
							<div class="counter-icon">
								<img src="<?php echo $skillset->skillset_icon_upload; ?>" alt="<?php echo strip_tags($skillset->skillset_title); ?>"></img>
							</div>
						<?php } ?>
					<?php } elseif ($skillset->skillset_icon_option == 'icon') { ?>
						<?php if (!empty($skillset->skillset_icon_icon)) { ?>
							<div class="counter-icon">
								<i class="<?php echo $skillset->skillset_icon_icon; ?> count-icon" alt="icon"></i>
							</div>
						<?php } ?>
					<?php } ?>
				<?php } ?>
			</div>
		</div>
	<?php endforeach; ?>
</div>
