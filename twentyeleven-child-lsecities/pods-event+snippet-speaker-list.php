<?php if(is_array($event_speakers)): ?>
  <dt>Speakers</dt>
  <dd>
    <ul>
    <?php foreach($event_speakers as $event_speaker): ?>
      <li><a href="#person-profile-<?php echo $event_speaker['slug'] ?>"><?php echo $event_speaker['name'] ?> <?php echo $event_speaker['family_name'] ?></a></li>
    <?php endforeach; ?>
    </ul>
  </dd>
<?php endif; ?>

<?php if(is_array($event_respondents)): ?>
  <dt>Respondents</dt>
  <dd>
    <ul>
    <?php foreach($event_respondents as $event_respondent): ?>
      <li><?php echo $event_respondent['name'] ?> <?php echo $event_respondent['family_name'] ?></li>
    <?php endforeach; ?>
    </ul>
  </dd>
<?php endif; ?>

<?php if(is_array($event_chairs)): ?>
  <dt>Chairs</dt>
  <dd>
    <ul>
    <?php foreach($event_chairs as $event_chair): ?>
      <li><?php echo $event_chair['name'] ?> <?php echo $event_chair['family_name'] ?></li>
    <?php endforeach; ?>
    </ul>
  </dd>
<?php endif; ?>

<?php if(is_array($event_moderators)): ?>
  <dt>Moderators</dt>
  <dd>
    <ul>
    <?php foreach($event_moderators as $event_moderator): ?>
      <li><?php echo $event_moderator['name'] ?> <?php echo $event_moderator['family_name'] ?></li>
    <?php endforeach; ?>
    </ul>
  </dd>
<?php endif; ?>
