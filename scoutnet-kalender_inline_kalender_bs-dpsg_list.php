<?php

// Datumsformatierung

$locale = 'de_DE'; // deutsches Ausgabeformat
$timezone = 'GMT'; // ursprüngliche Zeitzone

$datefmt = new dpsgDateFmt($locale,$timezone);

$monthyear = 'MMMM YYYY';
$shortmonth = 'MMM';
$fulldate = 'EEEE, dd. MMMM';
$datetime = 'EEEE, dd. MMMM @ HH:mm';
$startdate = 'EEEE, dd. MMM';
$enddate = 'EEEE, dd. MMM';
$time = 'HH:mm';

// Monats "Zähler" auf null

$currentmonth = null;

/* @var $event SN_Model_Event */
?>
<div>
<?php
foreach($events as $event) :

$duration['D'] = ceil( ($event->End - $event->Start) / (3600*24) ); // dauer berechnen (Tage)
$duration['H'] = ceil( ($event->End - $event->Start) / (3600) ); // dauer berechnen (Stunden)

// PLZ: if (trim($event->ZIP)!="") {echo htmlspecialchars($event->ZIP) . " ";}
?>

<?php echo ( $currentmonth != $datefmt->format($event->Start, $monthyear) ) ? '</div><h2 class="text-center my-4"> ' . $datefmt->format($event->Start, $monthyear) . '</h2><div class="row justify-content-center">' : '' ?>

<?php $currentmonth = $datefmt->format($event->Start, $monthyear); ?>
<div class="col-lg-6 col-xxl-4 mb-4">
<div class="card horizontal">
	<div class="row g-0">
		<div class="card-body">

			<p class="category-badge">
				<?php foreach($event->Stufen as $Stufe) : ?>
				<span class="badge text-decoration-none <?php echo strtolower(htmlspecialchars($Stufe['bezeichnung'])); ?>"><?php echo htmlspecialchars($Stufe['bezeichnung']); ?></span>
				<?php endforeach; ?>
			</p>

			<h4><?php echo htmlspecialchars(trim($event->Title)); ?></h4>
			
			<ul class="fa-ul ms-4">
			<li><span class="fa-li"><i class="fa-regular fa-calendar"></i></span><?php echo $datefmt->format($event->Start, $fulldate); ?></li>

			<li><span class="fa-li">
			<?php if ( $event->All_Day == 1 ) : ?>
				<?php echo ($datefmt->format($event->Start, $time) != "00:00") ? '<i class="fa-regular fa-clock"></i></span>' . $datefmt->format($event->Start, $time) . '</li><li><span class="fa-li">' : ''; ?>
				<i class="fa fa-hourglass"></i></span><?php echo $duration['D']; ?> Tage <?php echo ( $event->Start != $event->End ) ? '(bis ' . $datefmt->format($event->End, $enddate) .')' : ''; ?>
			<?php else : ?>
				<?php echo ($datefmt->format($event->Start, $time) != "00:00") ? '<i class="fa-regular fa-clock"></i></span>' . $datefmt->format($event->Start, $time) . '</li><li><span class="fa-li">' : ''; ?>
				<?php echo ($duration['H'] > 0) ? '</li><li><span class="fa-li"><i class="fa fa-hourglass"></i></span>' . $duration['H'] . ' Stunden' : ''; ?>
			<?php endif; ?>
			</li>

			<?php echo ($event->Location ? '<li><span class="fa-li"><i class="fa-solid fa-location-dot"></i></span>' . htmlspecialchars($event->Location) . '</li>' : ''); ?>
			</ul>

			<p class="card-text"><?php echo ($event->Description ? htmlspecialchars($event->Description) : "<i>keine Beschreibung</i>" ); ?></p>

			<?php if ( trim($event->URL) != "" ) : ?>
			<p class="card-text"><a class="read-more" title="<?php echo dpsg_short_url($event->URL, 100); ?>" href="<?php echo htmlspecialchars($event->URL); ?>"><?php echo (trim($event->URL_Text) ? htmlspecialchars($event->URL_Text) : 'Mehr Informationen'); ?><i class="dpsgi dpsgi-arrow-link ms-2"></i></a></p>
			<?php endif; ?>
			
		</div>

		<div class="card-footer text-body-secondary small"><?php echo ($event->Author->get_full_name() ? "Autor: " . htmlspecialchars($event->Author->get_full_name()) : "" ); ?> (ge&auml;ndert am <?php echo ($event->Last_Modified_At ? $datefmt->format($event->Last_Modified_At, $fulldate) : $datefmt->format($event->Created_At, $fulldate) ); ?>)</div>

	</div>
</div>
</div>

<?php endforeach; ?>