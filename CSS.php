<style>
    .account-wall {
        margin-top: 20px;
        padding: 40px 40px 20px 40px;
        background-color: #e4e0e0;
        -moz-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        -webkit-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        box-shadow: 2px 2px 100px rgba(0, 0, 0, 0.3);
        border-radius: 30px;
    }
		body { margin: 0px; }
		h1 { font-size: 1.5em; }
		label { font-size: 24px; }
		container {
			width: 175px;
			margin-left: 20px;
	}
	input[type=radio].with-font,
	input[type=checkbox].with-font {
		border: 0;
		clip: rect(0 0 0 0);
		height: 1px;
		margin: -1px;
		overflow: hidden;
		padding: 0;
		position: absolute;
		width: 1px;
	}
	input[type=radio].with-font ~ label:before,
	input[type=checkbox].with-font ~ label:before {
		font-family: FontAwesome;
		display: inline-block;
		content: "\f1db";
		letter-spacing: 10px;
		font-size: 1.2em;
		color: lightcoral;
		width: 1.4em;
	}
	input[type=radio].with-font:checked ~ label:before,
	input[type=checkbox].with-font:checked ~ label:before  {
		content: "\f00c";
		font-size: 1.2em;
		color: dodgerblue;
		letter-spacing: 5px;
	}
	input[type=checkbox].with-font ~ label:before {
		content: "\f096";
	}
	input[type=checkbox].with-font:checked ~ label:before {
		content: "\f046";
		color: dodgerblue;
	}
	input[type=radio].with-font:focus ~ label:before,
	input[type=checkbox].with-font:focus ~ label:before,
	input[type=radio].with-font:focus ~ label,
	input[type=checkbox].with-font:focus ~ label
	{
		color: dodgerblue;
	}
	function alertModal(title, body) {
	// Display error message to the user in a modal
	$('#alert-modal-title').html(title);
	$('#alert-modal-body').html(body);
	$('#alert-modal').modal('show');
	}
	.errors {
		max-width: 150px;
		color:red;
	}
	table, th, td{
		border: 2px solid dodgerblue;
		border-collapse: collapse;
		margin: 0 auto;
	}
	th, td{
		padding: 10px;
	}
	.center{
		margin: 0 auto;
		max-width: 300px;
	}
	.feedback{
		float:left;
	}
	.img{
		position:fixed right;
	}
	div.stars {
		width: 270px;
		display: inline-block;
	}
	input.star { display: none; }
	label.star {
		float: right;
		padding: 10px;
		font-size: 36px;
		color: #444;
		transition: all .2s;
	}
	input.star:checked ~ label.star:before {
		content: '\f005';
		color: #FD4;
		transition: all .25s;
	}
	input.star-5:checked ~ label.star:before {
		color: #FE7;
		text-shadow: 0 0 20px #952;
	}
	input.star-1:checked ~ label.star:before { color: #ff0008; }
	input.star-2:checked ~ label.star:before { color: #ff5200; }
	input.star-3:checked ~ label.star:before { color: #ff9007; }
	input.star-4:checked ~ label.star:before { color: #ffc533; }
	label.star:hover { transform: rotate(-72deg) scale(1.2); }
	label.star:before {
		content: '\f006';
		font-family: FontAwesome;
	}
	.heading {
	width: 410px;;
	color:dodgerblue;
	font-size: 50px;
	margin: 0 auto;
	}
	.ccenter{
		width: 300px;
		margin: 0 auto;
	}
	.delete{
		width: 105px;
		margin: 0 auto;
	}
	.backout{
		font-size:30px;
	}
	.buttons{
		width: 300px;
		margin: 0 auto;
		height: 50px;
	}
	.absolute{
    position: absolute;
	}	
	
</style>