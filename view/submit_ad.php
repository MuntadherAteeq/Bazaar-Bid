
<?php 

$category;
// category builder function, parentId 0 is the root
function buildOptions($parent, $category) {
    $html = "";

    foreach ($category['parents'][$parent] as $itemId) {
        if (!isset($category['parents'][$itemId])) {
            $html .= "<option value='" . $category['items'][$itemId]['id'] . "'>" . $category['items'][$itemId]['label'] . "</option>";
        }
        if (isset($category['parents'][$itemId])) {
            $html .= "<option value='" . $category['items'][$itemId]['id'] . "'>" . $category['items'][$itemId]['label'] . "</option>";
            $html .= buildcategory($itemId, $category);
        }
    }

    return $html;
}

// Assuming $category is populated with categories data
?>
<button type="button" class="btn btn-warning" data-toggle="modal" data-target=".bs-example3-modal-lg">
	Submit your Ad here!
</button>
<div class="modal fade bs-example3-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">

			<div class="container-fluid" id="container">
				<h2>Submit Your Ad!</h2>

				<form id="registerForm" action="add.php" method="post"  enctype="multipart/form-data" class="form-horizontal span8">
					<div class="control-group">
						<label class="control-label" for="ad_title">Ad Title</label>
						<div class="controls">
							<input type="text" required id="user_ad_title" class="form-control" name="Title" maxlength="25" />
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="discription">Discription</label>
						<div class="controls">
							<textarea class="form-control" rows="3" cols="17" name="Description"></textarea>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="last_name">Price</label>
						<div class="controls">
							<input type="number" required class="form-control" name="price" id="user_price" />
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="discription">Select your category</label>
						<div class="controls">
							<select required  name="Category" >
								<option value="Antique" disabled selected>--Categories--</option>
								<?php echo buildOptions(0, $category); ?>
							</select>
						</div>
					</div>
					<div class="control-group">
						<label class="control-lebel" for="Inputimg"> Image </label>
						<div class="controls"></div>
						<input type="file" required class="form-control" id="Inputimg" name="file">
					</div>

					
					<!-- TODO: ADD Date to the add product form  -->

					<div class="control-group">
						<label class="control-lebel" for="datepicker"> Deadline </label>
						<div class="controls">
							<input type="date" required class="form-control" id="datepicker" name="btime">
						</div>
					</div>
					 
					<hr />
					<div class="control-group">
						<div class="controls">
							<input id="submitButton" type="submit" class="btn btn-primary btn-lg btn-block" name="submit" value="Submit Now!"/>
						</div>
					</div>
					<br />
				</form>

			</div>

		</div>
	</div>
</div>

<script>

const form = document.getElementById('registerForm');
const submitButton = document.getElementById('submitButton');

submitButton.addEventListener('click', function(e) {
    const formData = new FormData(form);
    
    if (formData.get("file").size == 0) {
		e.preventDefault();
        alert("Please select an image");
        return;
    }
    
    if (!formData.get("Category")) {
		e.preventDefault();
        alert("Please select a Category");
        return;
    }
    
});

</script>