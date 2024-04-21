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
$customsStyle = $params->get('customsStyle');
$i = 0;
foreach ($skillsets as $skillset) {
    $i++;
}
if ($i == 1) {
    $count = 12;
} elseif ($i == 2) {
    $count = 6;
} elseif ($i == 3) {
    $count = 4;
} elseif ($i == 4) {
    $count = 3;
}
?>
<style>
	<?php foreach ($skillsets as $index => $skillset) : ?>
	<?php if ($customsStyle) { ?>#skillset-<?php echo $index; ?>-<?php echo $module->id; ?> .counter-title {
		font-size: <?php echo $titleSize; ?>px;
	}

	#skillset-<?php echo $index; ?>-<?php echo $module->id; ?> .counter-number .count {
		font-size: <?php echo $numberSize; ?>px;
	}

	#skillset-<?php echo $index; ?>-<?php echo $module->id; ?> .counter-number .symbol {
		font-size: <?php echo $symbolSize; ?>px;
	}

	#skillset-<?php echo $index; ?>-<?php echo $module->id; ?> .count-icon {
		font-size: <?php echo $iconSize; ?>px;
	}

	<?php } ?><?php if ($customsStyle) { ?>#skillset-<?php echo $index; ?>-<?php echo $module->id; ?> .counter-title {
		color: <?php echo $titleColor; ?>;
	}

	#skillset-<?php echo $index; ?>-<?php echo $module->id; ?> .counter-number .count {
		color: <?php echo $numberColor; ?>;
	}

	#skillset-<?php echo $index; ?>-<?php echo $module->id; ?> .counter-number .symbol {
		color: <?php echo $symbolColor; ?>;
	}

	#skillset-<?php echo $index; ?>-<?php echo $module->id; ?> .count-icon {
		color: <?php echo $iconColor; ?>;
	}

	<?php } ?>
	<?php endforeach; ?>
</style>
<div id="cg_skillset<?php echo $module->id; ?>" data="<?php echo $module->id; ?>" class="cg_skillset cg-row counter-sub-container skillset-not-counted <?php if ($params->get('IconPosition') == 'left') {
    echo 'cg-icon-position-left';
} ?><?php if ($params->get('IconPosition') == 'right') {
    echo 'cg-icon-position-right';
} ?> ">
	<?php foreach ($skillsets as $index => $skillset) : ?>
		<div class="cg-col-12 cg-col-md-6 cg-col-lg-<?php echo $count; ?>" id="skillset-<?php echo $index; ?>-<?php echo $module->id; ?>">
			<div class="counter-wrapper">
				<?php if ($params->get('IconPosition') == 'top' or $params->get('IconPosition') == 'right' or $params->get('IconPosition') == 'left') { ?>
					<?php if ($skillset->skillset_icon_option == 'upload') { ?>
						<?php if (!empty($skillset->skillset_icon_upload)) { ?>
							<div class="counter-icon">
								<img src="<?php echo $skillset->skillset_icon_upload; ?>" alt="<?php echo $skillset->skillset_title; ?>"></img>
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
				<?php } ?>
				<?php if ($params->get('IconPosition') == 'bottom') { ?>
					<?php if ($skillset->skillset_icon_option == 'upload') { ?>
						<?php if (!empty($skillset->skillset_icon_upload)) { ?>
							<div class="counter-icon">
								<img src="<?php echo $skillset->skillset_icon_upload; ?>" alt="<?php echo $skillset->skillset_title; ?>"></img>
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
