<template>
	<h1>Hello, it's a wonderful component!</h1>
	<p id="paragraph">There is a text for replacing.</p>

	<div class="sass">
		<h2>SASS</h2>
		<p>You can use SASS instantly in template!</p>
	</div>
</template>

<script>
	$("#paragraph").text("Now you see all power of Apex template engine!");
</script>

<style>
	h1 {
		font-size: 24px;
	}
	.sass {
	    p {
	        color: red;
	    }
	}
</style>

