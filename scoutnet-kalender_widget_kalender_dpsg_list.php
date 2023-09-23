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

$shortmonth = new IntlDateFormatter('de_DE', IntlDateFormatter::MEDIUM, IntlDateFormatter::NONE,'Europe/Berlin',IntlDateFormatter::GREGORIAN, 'MMM');

if ($ajaxcall !== true) : ?>
	<div class="<?php echo $wrapclassname; ?>" style="min-height: 251px;">Lade Scoutnet-Daten ...</div>
<?php else : ?>
	<script>
		var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
		var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) { return new bootstrap.Tooltip(tooltipTriggerEl) });
	</script>
	<div class="d-grid row-gap-3">
	<?php foreach($events as $event) { /* @var $event SN_Model_Event */ ?>
		<div class="d-flex" data-bs-toggle="tooltip" title="<?php echo htmlspecialchars(trim($event->Title)); if ( $event->Description ) : echo ": " . htmlspecialchars($event->Description); endif; ?>">
			<div class="d-felx flex-shrink-0">
				<div class="">
					<small class="d-flex justify-content-center bg-secondary text-white py-0 px-2 rounded-top small font-monospace text-uppercase"><?php echo substr($shortmonth->format($event->Start),0,3); ?></small>
					<h5 class="d-flex justify-content-center py-1 rounded-bottom border border-top-0 m-0"><?php echo date('d', $event->Start); ?></h5>
				</div>
			</div>
			<div class="d-flex flex-grow-1 ms-3 mb-0">
				<div class="col-11 col-md-6 col-lg-7 col-xl-9 col-xxl-11">
					<h6 class="mb-0 text-truncate"><?php echo htmlspecialchars(trim($event->Title)); ?></h6>
					<span class="text-muted small">
						<?php if ( $event->Location ) : ?>
							<div>
								<i class="fa fa-location me-1" style="width:1em; text-align:center;"></i><?php echo htmlspecialchars($event->Location); ?>
							</div>
						<?php endif; ?>
						<?php if ( $event->All_Day == 1 ) : ?>
							<div>
								<?php if ( date('G:i', $event->Start) != "2:00" ) : ?><i class="fa fa-clock me-1" style="width:1em; text-align:center;"></i><?php echo date('G:i', $event->Start); ?><?php endif; ?>
								<i class="fa fa-hourglass me-1" style="width:1em; text-align:center;"></i><?php echo floor( ($event->End - $event->Start) / (3600*24) ); ?> Tage
							</div>
						<?php else : ?>
							<?php $duration = floor( ($event->End - $event->Start) / (3600) ); // dauer berechnen (stunden) ?>
							<div>
								<i class="fa-regular fa-clock me-1" style="width:1em; text-align:center;"></i><?php echo strftime('%R', $event->Start); ?>
								<?php if ( $duration > 0 ) : ?><i class="fa fa-hourglass me-1" style="width:1em; text-align:center;"></i><?php echo $duration; ?> Stunden<?php endif; ?>
							</div>
						<?php endif; ?>
						<?php if (trim($event->URL)!="") : ?>
						
							<?php if (trim($event->URL_Text)!="") : ?>
								<a href="<?php echo $event->URL; ?>"><?php echo htmlspecialchars($event->URL_Text); ?><i class="dpsgi dpsgi-arrow-link ms-2"></i></a>
							<?php else : ?>
								<a href="<?php echo $event->URL; ?>">Mehr Informationen<i class="dpsgi dpsgi-arrow-link ms-2"></i></a>
							<?php endif; ?>

						<?php endif; ?>
					</span>
				</div>
			</div>
		</div>
	<?php } ?>
	</div>
<?php endif; ?>