@extends('layouts.landing')


@section('content')

<style>
	main{
		padding-left:0;
		padding-top: 0;
	}
	container {
		display: table-cell;
	}
	ul a{
	  color: #444;
	}
	.content,#index-banner{
		height:100%;
	}
	i { 
		color: orangered; 
		font-size: 6rem!important;
	}
	p {
	  	line-height: 2rem;
		text-align:center;
	} 
	.button-collapse {
	  color: #26a69a;
	} 
	.parallax-container {
	  min-height: 380px;
	  line-height: 0;
	  height: auto;
	  color: rgba(255,255,255,.9);
	}
	.parallax-container .section {
		display: table;
		width: 100%;
		height:100%;
	}	
	.parallax-container .container {
		display:table-cell;
		vertical-align:middle;
	}
	#features{
		height: 511px;
		display: table-cell;
		vertical-align: middle; 
	}
	#networks{
		width: 120%;
	}

	#networks-container{
		display: block!important;
		background:white;
		border-radius: 5px;
    	box-shadow: 0px 0px 5px 3px rgba(249, 236, 236, 0.7);
		color: orangered;  
		width: 620px;
	}
	#index-banner{
		background-color: rgba(137, 81, 81, 0.32); 
	}
	#index-banner h1{
		font-size: 9rem;
		text-shadow: 4px 4px 4px #d22727;
	}
	#index-banner h5{
		font-size: 2rem;
		text-shadow: 0px 3px 0px #5b5a9e;
	}
	#contact-container{
		height:100%;
	}
	#contact{
		background-color:white;
		color:initial;
		height:30%;
		padding:70px;
	}
	@media only screen and (max-width : 992px) {
	  .parallax-container .section {
		position: absolute;
/*		top: 40%;*/
	  }
	  #index-banner .section {
/*		top: 10%;*/
	  }
	}

	@media only screen and (max-width : 600px) {
	  #index-banner .section {
		top: 0;
	  }
	}

	.icon-block {
	  padding: 0 15px;
	}
	.icon-block .material-icons {
	  font-size: inherit;
	}

	footer.page-footer {
	  margin: 0;
	}
</style> 
  <div id="index-banner" class="parallax-container">
    <div id="home" class="section no-pad-bot scrollspy">
      <div class="container">
        <br><br>
        <h1 class="header center white-text text-lighten-2">TVScout</h1>
        <div class="row center">
          <h5 class="header col s12 light"> The place to track all your series instantly and effectively. Just some clicks away!</h5>
        </div> 
        <br><br> 
      </div>
    </div>
    <div id="first-background" class="parallax"><img src="{{ URL::asset('photos/asset2.jpg') }}" alt="Unsplashed background img 1"></div>
  </div>


  <div id="features-container" class="container">
    <div id="features" class="section scrollspy">

      <!--   Icon Section   -->
      <div class="row">
        <div class="col s12 m4">
          <div class="icon-block">
            <h2 class="center brown-text"><i class="material-icons">flash_on</i></h2>
            <h5 class="center">TV Schedule</h5>

            <p class="light">By adding TV shows into your watchlist TVScout automatically makes up your TV schedule so that you can always know when any episode of your watchlist is airing.</p>
          </div>
        </div>

        <div class="col s12 m4">
          <div class="icon-block">
            <h2 class="center brown-text"><i class="material-icons">group</i></h2>
            <h5 class="center">Series info</h5>

            <p class="light">Get all the needed information about a TV show. From series genre to episodes description, you can get it all.</p>
          </div>
        </div>

        <div class="col s12 m4">
          <div class="icon-block">
            <h2 class="center brown-text"><i class="material-icons">settings</i></h2>
            <h5 class="center">Suggestions</h5>

            <p class="light">Tired of searching for a new show to watch? We've got you handled. With the popular section you can always have something to watch.</p>
          </div>
        </div>
      </div>

    </div>
  </div>


  <div class="parallax-container valign-wrapper">
    <div class="section no-pad-bot">
      <div id="networks-container"class="container">
        <div class="row center">
          <h5 class="header col s12 light">Series from all your favorite channels</h5>
        </div>
      </div>
    </div>
    <div class="parallax"><img id="networks" src="{{ URL::asset('photos/asset1.jpg') }}" alt="Unsplashed background img 2"></div>
  </div>  

  <div id="contact-container" class="parallax-container">
    <div id ="contact" class="container-fluid"> 
      <div class="row">
        <div class="col s12 center"> 
          <h4>Contact </h4>
          <p class="left-align light center"> For any further information or request feel free to send me an email at <b>sntokos@outlook.com</b></p>
        </div>
      </div> 
    </div>
    <div class="parallax"><img src="{{ URL::asset('photos/asset3.jpg') }}" alt="Unsplashed background img 3"></div>
  </div> 

@endsection