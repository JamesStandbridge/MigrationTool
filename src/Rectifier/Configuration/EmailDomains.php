<?php

namespace MigrationTool\Rectifier\Configuration;

final class EmailDomains {
	
	public static function TO_ARRAY() : array
	{
		return self::LIST;
	}

	public static function EXPLODE(string $domain) : array
	{
		$exploded = explode('.', $domain);

		$domain = $exploded[0];
		$extension = "";
		for($i = 1; $i < count($exploded); $i++)
			$extension .= '.'.$exploded[$i];
		
		return array(
			"domain" => $domain,
			"extension" => $extension
		);
	}

	const LIST = array(
		"alice.it",
		"virgilio.it",
		"tin.it",
		"tim.it",
		"aol.fr",
		"me.com",
		"mac.com",
		"icloud.com",
		"arcor.de",
		"bluewin.ch",
		"blueyonder.co.uk",
		"bbox.fr",
		"btinternet.com",
		"comcast.net",
		"email.it",
		"facebook.com",
		"free.fr",
		"aliceadsl.fr",
		"infonie.fr",
		"libertysurf.fr",
		"online.fr",
		"freesbee.fr",
		"alicepro.fr",
		"worldonline.fr",
		"freenet.de",
		"caramail.com",
		"gmx.fr",
		"gmail.com",
		"googlemail.com",
		"home.nl",
		"laposte.net",
		"libero.it",
		"blu.it",
		"giallo.it",
		"bk.ru",
		"windowslive",
		"dbmail.com",
		"hotmail.fr",
		"live.fr",
		"msn.fr",
		"outlook.fr",
		"telefonica.es",
		"movistar.es",
		"numericable.fr",
		"noos.fr",
		"o2.pl",
		"orange.fr",
		"wanadoo.fr",
		"skynet.be",
		"rambler.ru",
		"lenta.ru",
		"autorambler.ru",
		"myrambler.ru",
		"ro.ru",
		"r0.ru",
		"sfr.fr",
		"neuf.fr",
		"9online.fr",
		"9business.fr",
		"cegetel.net",
		"club-internet.fr",
		"cario.fr",
		"guideo.fr",
		"mageos.com",
		"fnac.net",
		"waika9.com",
		"sky.com",
		"telenet.be",
		"tiscali.co.uk",
		"t-online.de",
		"verizon.net",
		"ono.com",
		"voila.fr",
		"web.de",
		"wp.pl",
		"yahoo.fr",
		"ymail.com",
		"rocketmail.com",
		"yandex.ru",
		"mail.com",
		"talktalk.net",
	);
}