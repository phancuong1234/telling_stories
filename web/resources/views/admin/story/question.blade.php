     <div>
            <div>
              <label class="col-2" for="exampleFormControlSelect2">Question</label>
              <button type="button" class="btn btn-success" id="show_add">Create</button>
            </div>
            <div class="row form-group" style="display: none;" id= "form_add">
              <label class="col-2" for="exampleFormControlSelect2">Question</label>
              <div class="col-10">
               <div>
                <label  for="exampleFormControlSelect2">Number 1:</label>
                <div>
                 <div class="row form-group">
                  <label class="col-2" for="post">Question</label>
                  <textarea class="form-control col-7" id="exampleFormControlTextarea1"></textarea>
                </div>
                <div class="row form-group">
                  <label class="col-2" for="post">Answer 1</label>
                  <input class="form-control col-7" type="text" name="answer1" value="" id="answer1" placeholder="Answer">
                </div>
                <div class="row form-group">
                  <label class="col-2" for="post">Answer 2</label>
                  <input class="form-control col-7" type="text" name="answer2" value="" id="answer2" placeholder="Answer">
                </div>
                <div class="row form-group">
                  <label class="col-2" for="post">Answer 3</label>
                  <input class="form-control col-7" type="text" name="answer3" value="" id="answer3" placeholder="Answer">
                </div>
                <div class="row form-group">
                  <label class="col-2" for="post">Answer 4</label>
                  <input class="form-control col-7" type="text" name="answer4" value="" id="answer4" placeholder="Answer">
                </div>
              </div>
            </div>
            <a href="{{ url()->previous() }}" class="btn btn-secondary">Cancel</a>
            <button type="button" class="btn btn-success" id="submit">Add
            </button>
          </div>
        </div>
      </div>