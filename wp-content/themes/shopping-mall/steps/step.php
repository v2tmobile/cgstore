 <?php
  print_r($tutorial_step_data);
  ?>
  <div class="input-container">
    <input class="step-position field" value="Step 1" maxlength="110" size="110" type="text" name="tu[step][title][]" id="tutorial_tutorial_steps_attributes__title">
  </div>
  <div class="redactor_box">
    <textarea name="tu[step][content][]" class="tutorial-editor"></textarea>
  </div>
  <a class="button button--alt remove_fields dynamic" href="#">Remove step</a>