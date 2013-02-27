<?php
/**
 * @package Hello_Lionel
 * @version 1.6
 */
/*
Plugin Name: Hello Lionel
Plugin URI: https://github.com/kevinsmasters/hello-lionel
Description: I got bored so I changed the lyrics in the Hello Dolly plugin and replaced them with words from Lionel Richie's Hello. When activated you will randomly see a lyric from <cite>Hello</cite> in the upper right of your admin screen on every page.
Author: Kevin Masters
Version: 0.5
Author URI: http://www.kevinmasters.com/
*/

function hello_lionel_get_lyric() {
	/** These are the lyrics to Hello */
	$lyrics = "Hello,
I've been alone with you inside my mind
And in my dreams I've kissed your lips a thousand times
I sometimes see you pass outside my door
Hello, is it me you're looking for?

I can see it in your eyes
I can see it in your smile
You're all I've ever wanted, (and) my arms are open wide
'Cause you know just what to say
And you know just what to do
And I want to tell you so much, I love you ...

I long to see the sunlight in your hair
And tell you time and time again how much I care
Sometimes I feel my heart will overflow
Hello, I've just got to let you know

'Cause I wonder where you are
And I wonder what you do
Are you somewhere feeling lonely, or is someone loving you?
Tell me how to win your heart
For I haven't got a clue
But let me start by saying, I love you ...

Hello, is it me you're looking for?
'Cause I wonder where you are
And I wonder what you do
Are you somewhere feeling lonely or is someone loving you?
Tell me how to win your heart
For I haven't got a clue
But let me start by saying ... I love you";

	// Here we split it into lines
	$lyrics = explode( "\n", $lyrics );

	// And then randomly choose a line
	return wptexturize( $lyrics[ mt_rand( 0, count( $lyrics ) - 1 ) ] );
}

// This just echoes the chosen line, we'll position it later
function hello_lionel() {
	$chosen = hello_lionel_get_lyric();
	echo "<p id='dolly'>$chosen</p>";
}

// Now we set that function up to execute when the admin_notices action is called
add_action( 'admin_notices', 'hello_lionel' );

// We need some CSS to position the paragraph
function dolly_css() {
	// This makes sure that the positioning is also good for right-to-left languages
	$x = is_rtl() ? 'left' : 'right';

	echo "
	<style type='text/css'>
	#dolly {
		float: $x;
		padding-$x: 15px;
		padding-top: 5px;		
		margin: 0;
		font-size: 11px;
	}
	</style>
	";
}

add_action( 'admin_head', 'dolly_css' );

?>
