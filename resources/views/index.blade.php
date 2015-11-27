<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Araby Alhomsi - blog</title>

	<!-- CSS Files -->
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,300|Roboto:400,700,500' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="{{ asset('css/vendor.css') }}">
	<link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>

	<div class="wrapper">
		<div class="sidebar">
			<div class="navigation">
				<ul class="navigation__list--one">
					<li><a href="#">Home</a></li>
					<li><a href="#">Portfolio</a></li>
					<li><a href="#">Contact</a></li>
					<li><a href="#">About</a></li>
				</ul>
				<ul class="navigation__list--two">
					<li><a href="#">Home</a></li>
					<li><a href="#">Portfolio</a></li>
					<li><a href="#">Contact</a></li>
					<li><a href="#">About</a></li>
				</ul>
			</div>
			<div class="sidebar__content-block website-title">
				<h1>Araby Alhomsi</h1>
			</div>
			<div class="sidebar__content-block">
				<img class="profile-image" src="/images/profile-image.png" alt="Profile Image Araby Alhomsi">
				<p class="bio-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint quod impedit aperiam tempora minima at veniam iure ullam optio! Corrupti vitae saepe officia, quisquam ullam similique, veritatis sunt perferendis voluptatum?</p>
			</div>
			<div class="sidebar__content-block">
				<ul class="social-links">
					<li><a href="#"><i class="fa fa-facebook"></i></a></li>
					<li><a href="#"><i class="fa fa-twitter"></i></a></li>
					<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
					<li><a href="#"><i class="fa fa-github"></i></a></li>
				</ul>
			</div>
		</div>
		<div class="content">
			<div class="content__post blog-post blog-post--image">
				<img src="/images/blog-image.jpeg" alt="The name of the Article">
				<div class="blog-post__inner">
					<h2>Even the Celebrities Wanted to Dress Weather Appropriately This Week</h2>
					<div class="blog-post__meta">
						<span><i class="fa fa-calendar"></i></span>
						<span><i class="fa fa-bookmark"></i></span>
						<span><i class="fa fa-eye"></i></span>
						<span><i class="fa fa-comment"></i></span>
					</div>
					<div class="blog-post__excerpt">
						<p>There are those who believe that life here began out there… far across the universe, with tribes of humans who may have been the forefathers of the Egyptians or the Toltecs or the Mayans. Some believe that there may yet be brothers of man who even now fight to survive somewhere beyond the heavens. Fleeing from the Cylon Tyranny, the last Battlestar – Galactica –…</p>
					</div>
					<button class="readmore-button">READ MORE</button>
				</div>
			</div>
		</div>
		<div class="clear"></div>
	</div>
	
	<script src="{{ asset('js/vendor.js') }}"></script>
	<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>