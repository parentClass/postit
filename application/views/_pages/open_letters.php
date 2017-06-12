
  <div class="container">
    <form class="form-inline text-center">
      <h1>Open letters</h1>
      <a href="#" class="btn btn-block text-info" data-toggle="modal" data-target="#writeLetterModal">
        Write letter
      </a>
    </form>
    <? if(!empty($open_letters[0]['letter_status'])): ?>
      <br/><br/>
      <p class="text-center lead">
        <? echo $open_letters[0]['letter_status']; ?>
      </p>
    <? else: ?>
      <? foreach($open_letters as $row): ?>
        <div class="card ol-card">
          <div class="card-block ol-card-block">
            <h4 class="card-title" style="font-family: 'Playfair Display' !important;">
              <? echo $row['letter_title'] ?>
            </h4>
            <small class="card-subtitle mb-2 text-muted">
              <? echo $row['sent_at']; ?> from
              <a href="../blog/<? echo substr($row['letter_from'],1); ?>">
                <small>
                    <? echo $row['letter_from']; ?>
                </small>
              </a>
            </small>
            <p class="card-text text-justify letter-body">
              <? echo $row['letter_body']; ?>
            </p>
            <a href="#!" onclick="writeBackTo('<? echo '@'. $currUser . "','" . $row['letter_from']; ?>')" class="card-link" data-toggle="modal" data-target="#writeBackModal">
              Write back
            </a>
            <a href="#!" onclick="specifyLetter(<? echo '@'. $currUser . ',' . $row['letter_from']; ?>)" class="card-link ignore-link" data-toggle="modal" data-target="#ignoreLetterModal">
              Ignore letter
            </a>
          </div>
        </div>
      <? endforeach; ?>
   <? endif; ?>
  </div>

  <div id="snackbar-empty">We cannot post a unfilled adventure.</div>
  <div id="snackbar-empty-letter">We cannot send a unfilled letter to a user.</div>
  <div id="snackbar-success">Success! I'm about to reload the page in a bit.</div>
  <div id="snackbar-danger">Failed! I encountered a problem doing the request.</div>
