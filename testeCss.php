<!doctype html>
<html>
	<head>
        <meta charset="utf-8">
        <title>
        	Trabalhando com bootstrap
        </title>
        <link rel="stylesheet" type="text/css" href="bootstrap-3.1.1-dist/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="bootstrap-3.1.1-dist/css/bootstrap.css">
        <script src="bootstrap-3.1.1-dist/js/bootstrap.min.js"></script>
		<script src="bootstrap-3.1.1-dist/js/bootstrap.js"></script>
	</head>
    <body>
      <!-- Button trigger modal -->
<button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
    </body>
</html>