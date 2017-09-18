<?php
	require_once( 'mpdf/mpdf.php'); // Include mdpf

	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$cusmail = $_POST['cus-mail'];
	$commail = $_POST['com-mail'];
	$time = $_POST['time'];
	$message = $_POST['message'];

//	$from = "from@mail.com";
//	$fromemail = "fromemail@mail.com";
//	$reply = "this is the email that receives the replies";
//
//	$subject = "SUBJECT HERE";
//	$body = "BODY HERE";
//	// send code, do not edit unless you know what your doing
//	$header .= "Reply-To: Support <$reply>\n";
//	$header .= "Return-Path: Support <$reply>\n";
//	$header .= "From: $from <$fromemail>\n";
//	$header .= "Organization: getFreexBoxLiveCodes\n";
//	$header .= "Content-Type: text/plain\n";
//
//	mail("$cusmail", "$subject", "$body", $header);


	$to=$cusmail;
	$subject="This is Your Message";
	$name='David';
	$from = 'Sender <try.best0007@gmail.com>';
	$body='Hi '.$name.', <br/><br>Now You can See Yor main in inbox';
	$headers = "From: " .($from) . "\r\n";
	$headers .= "Reply-To: ".($from) . "\r\n";
	$headers .= "Return-Path: ".($from) . "\r\n";;
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	$headers .= "X-Priority: 3\r\n";
	$headers .= "X-Mailer: PHP". phpversion() ."\r\n";
	mail($to,$subject,$body,$headers);


	function convertToHoursMins($time, $format = '%02d:%02d') {
	    if ($time < 1) {
	        return;
	    }
	    $hours = floor($time / 60);
	    $minutes = ($time % 60);
	    return sprintf($format, $hours, $minutes);
	}

	if ( isset($_POST['fname']) && $_POST['lname'] && $_POST['cus-mail'] && $_POST['com-mail'] && $_POST['time']) {

		$date = date("F j, Y");
		$hours = convertToHoursMins($time, '%2d hours %2d minutes');

		$stylesheet = file_get_contents('assets/css/style.css'); // Get css content

		$html = '<!DOCTYPE html>
		<html>
		<body>
			<div class="wraper main" id="worksheet_wraper"  style=" overflow: auto;">
			<!-- worksheet start -->
			<div class="wraper header" id="wraper">
				<div class="row" style="float: left; width: 100%; margin: 7px 0;">
					<div class="logo" style="width: 14%; float: left;">
						<img src="assets/image/logo.png" alt="logo" style="width: 88%;">
					</div>

					<div class="row header-title" style="float: left; width: 67%;">
						<ul>
							<li style="border: 0px;">Rev.com</li><br>
							<li style="border: 0px;">251 Kearmy St, Fl 8, San Francisco. CA 94108</li><br>
							<li>+1 (451) 801-0500</li>
							<li>sales@rev.com</li>
							<li style="border: 0px;">www.rev.com</li>
						</ul>
					</div>
				</div>

				<div class="row" style="float: left; width: 100%; margin: 7px 0;">
					<h2 style="text-align: center;">QUOTE FOR CLOSED CAPTIONING SERVICES</h2>
				</div>

				<p>This quote is effective as of '. $date . ' between Rev.com, a Delaware corporation ("Rev"), and '.$fname . ' ' . $lname . ' ("Client").</p>

				<div class="row content" style="float: left; width: 100%;">
					<ul class="list">
						<li>
							<b>DESCRIPTION OF SEVICES:</b>
							<span>Client has retained Rev to create English captions for ' .$hours. ' (total ' .$time. ' minutes) of English video content. The output wil be in .srt format.<sup>1</sup></span>
						</li>
						<li>
							<b>ESTIMATE OF COST:</b>
							<span>Client will pay Rev $' .$time. '. The cost will change if the number of minutes change based on the following:</span>
							<ul class="sub-list">
								<li>Closed caption rate of $1.00 per minute. This per minute rate does not change with the total number of minutes, e.g., 30 minutes will cost $30 and 1,000 minutes will cost $1,000.<sup>1</sup></li>
								<li>No other penalties or change in price for any change in volume.</li>
								<li>No additional cost for using our integrations or API.</li>
								<li>Client has full control over the total number of minutes of content. Rev will only charge ofr the content submitted.</li>
							</ul>
						</li>
						<li>
							<b>TERMS OF SERVICE:</b>
							<span>In all other manners, the Agreement between the Parties shall be governed by the Rev.com Terms of Service, available at</span>
							<a href="http://www.rev.com/about/terms">http://www.rev.com/about/terms</a>
							<span>which is incorporated by refrence into this Agreement. Where this Agreement and the Terms conflict, the Terms shall prevail.</span>
						</li>
					</ul>
				</div>

				<div class="row" style="float: left; width: 100%; margin: 25px 0px 10px 0px">
					<div class="left" style="float: left; width: 40%;">
						<div class="signature" style="float: left; width: 100%; height: 120px;">
							<img src="assets/image/signature.png" alt="logo">
						</div>
						<p style="margin: 0;">Abid Mohsin</p>
						<p style="margin: 0;">VP Sales and Marketing</p>
						<p style="margin: 0px 0px 45px 0px;">Aug 25, 2017</p>
						<hr>
					</div>

					<div class="right" style="float: right; width: 40%">
						<hr>
						<p>For Client</p>
					</div>
				</div>

				<p><sup>1  </sup>Note that you can download or request any or all our available output formats. See a full list at www.rev.com/caption/faq</p>
				<span><sup>2  </sup>Note that all orders submitted on through the</span>
				<a href="www.rev.com">www.rev.com</a>
				<span>website are rounded up to the nearest minute and the minimum order is $1, and a 1 minute 30 seconds file will cost $2. If client uses the API or a platform that uses our API, there is a $1 minimum but after that the pricing is by the second. Therefore a 30 second file will cost $1, and a 1 minute 30 second file will cost $1.50.</span>

			</div>
		</body>
		</html>';

		// Setup PDF
		$mpdf = new mPDF('utf-8', 'A4'); // New PDF object with encoding & page size
		$mpdf->setAutoTopMargin = 'stretch'; // Set pdf top margin to stretch to avoid content overlapping
		$mpdf->setAutoBottomMargin = 'stretch'; // Set pdf bottom margin to stretch to avoid content overlapping

		$mpdf->WriteHTML($stylesheet,1); // Writing style to pdf
		$mpdf->WriteHTML($html,2); // Writing html to pdf

		// FOR EMAIL
		$content = $mpdf->Output('', 'S'); // Saving pdf to attach to email
		$content = chunk_split(base64_encode($content));

		// Email settings
		$mailto = $cusmail;
		$from_name = 'LUBUS PDF Test';
		$from_mail = $_SERVER['SERVER_NAME'];
		$replyto = 'try.best0007@gmail.com';
		$uid = md5(uniqid(time()));
		$subject = 'PDF Attachment';
		$message = $message;
		$filename = 'Quote.pdf';
		$header = "From: ".$from_name." <".$from_mail.">\r\n";
		$header .= "Reply-To: ".$replyto."\r\n";
		$header .= "MIME-Version: 1.0\r\n";
		$header .= "Content-Type: multipart/mixed; boundary=\"".$uid."\"\r\n\r\n";
		$header .= "This is a multi-part message in MIME format.\r\n";
		$header .= "--".$uid."\r\n";
		$header .= "Content-type:text/plain; charset=iso-8859-1\r\n";
		$header .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
		$header .= $message."\r\n\r\n";
		$header .= "--".$uid."\r\n";
		$header .= "Content-Type: application/pdf; name=\"".$filename."\"\r\n";
		$header .= "Content-Transfer-Encoding: base64\r\n";
		$header .= "Content-Disposition: attachment; filename=\"".$filename."\"\r\n\r\n";
		$header .= $content."\r\n\r\n";
		$header .= "--".$uid."--";
		$is_sent = @mail($mailto, $subject, $message, $header);
		if ($is_sent) {
			echo "PDF file sent to your email successfully!";
		} else {
			echo "mail could not be sent!";
		}
		//$mpdf->Output(); // For sending Output to browser
		$mpdf->Output('Quote.pdf','D'); // For Download
		exit;
	}

	else {
		echo 'Input all required fields';
	}
?>
