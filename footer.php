<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>footer</title>

<script src="https://maps.googleapis.com/maps/api/js"></script>
<script>
  function initialize() {
	var mapCanvas = document.getElementById('map-canvas');
	var mapOptions = {
	  center: new google.maps.LatLng(54.977621,-1.616938),
	  zoom: 14,
	  mapTypeId: google.maps.MapTypeId.ROADMAP
	}
	var map = new google.maps.Map(mapCanvas, mapOptions)
  }
  google.maps.event.addDomListener(window, 'load', initialize);
</script>

<link href="CSS/Footer.css" rel="stylesheet" type="text/css" />
</head>

<body>

<div class="portfolio">

  <div class="portfoliobox2">
    <div class="portfolioimg">
      <img src="Images/Website/Footer/nubs.jpg" class="portfolioimg" width="100%" height="528" />
    </div>
    <div class="portfoliotext">
      <p>NUBS</p>
    </div>
  </div>
  
  <div class="portfoliobox2">
    <div class="portfolioimg">
      <img src="Images/Website/Footer/north.jpg" class="portfolioimg" width="100%" height="528" />
    </div>
    <div class="portfoliotext">
      <p>North East Events</p>
    </div>
  </div>
  
  <div class="portfoliobox2">
   <div class="portfolioimg">
      <img src="Images/Website/User accounts/bg.jpg" class="portfolioimg" width="100%" height="528" />
    </div>
    <div class="portfoliotext">
      <p>Free Events</p>
    </div>
  </div>
  
  <div class="portfoliobox2">
    <div class="portfolioimg">
      <img src="Images/Website/Footer/help.jpg" class="portfolioimg" width="100%" height="528" />
    </div>
    <div class="portfoliotext">
      <p>Donate</p>
    </div>
  </div>
    
</div>

<div class="map">
  <div class="maplocation">
    <p>Powered by Google Maps <img src="http://www.google.com/s2/favicons?domain=www.google.de" width="15" height="15" />  </p>
  </div>
  <div id="map-canvas">
  </div>
</div>
  
<div class="footer">
  <div class="footercontainer">
    
      
      <div class="footertextboxleft">
      
      <div class="footertext">Charityfiy
      </div>
      
      <div class="footertext">SEO Optimisation
      </div>
      
      <div class="footertext">CMS</div>
      
      <div class="footertext">NUBS
      </div>
      
      <div class="footertext">Northumbria University
      </div>  
      
      <div class="footertext">Events
      </div>
      
      <div class="footertext">Charity
      </div>
      
      <div class="footertext">Business
      </div>
      
      <div class="footertext">Development
      </div>
      
      <div class="footertext">Awareness
      </div>
      
      <div class="footertext">Marketing
      </div>  
      
      <div class="footertext">Fund Raising
      </div>  
      
      <div class="footertext">Refugee
      </div>
      
      <div class="footertext">Raise Money
      </div>
      
      <div class="footertext">Children In Need
      </div>
      
      </div>
 
    </div>
  </div>
  <div class="footerend">
  <style type="text/css">
	ii {
		color:#CCC;
	}
  </style>
    <p>© Charityfiy. All rights reserved. | Customisation Done by <ii>Sufyan Ahmed</ii> | Design by <ii>GROUP 10<ii/>.</p>
  </div>
</div>
  




</body>
</html>