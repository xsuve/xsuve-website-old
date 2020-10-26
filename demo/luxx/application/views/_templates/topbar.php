<?php

// Notifications
$notifications_model = $this->loadModel('NotificationsModel');
$notifications = $notifications_model->getAccountNotifications($account->id, 5);
$hasNotifications = $notifications_model->hasNotifications($account->id);

?>

<!-- Topbar -->
<div class="topbar b-white">
  <div class="v-middle">
    <div class="row">
      <div class="col-lg-3">
        <div class="topbar-links topbar-add-link-box">
          <a href="#" class="topbar-link topbar-add-link">
            <div class="topbar-link-box text c-gray text-center">
              <i class="topbar-link-box-icon fe fe-plus v-middle"></i>
            </div>
          </a>
        </div>
        <h2 class="topbar-title c-title"></h2>
      </div>
      <div class="col-lg-5 p-left-0">
        <div class="topbar-search v-middle">
          <input type="text" placeholder="&#xf14e;&nbsp;&nbsp;Search contacts, projects, invoices, tasks or categories" class="text c-text" id="searchBar">
        </div>
      </div>
      <div class="col-lg-4 text-right">
        <div class="topbar-links">
          <!-- <a href="#" class="topbar-link">
            <div class="topbar-link-box text c-gray text-center">
              <i class="topbar-link-box-icon fe fe-commenting v-middle"></i>
            </div>
          </a> -->
          <!-- <div id="notificationsBtn" class="topbar-link">
            <div class="topbar-link-box notifications-btn text c-gray text-center">
              <i class="topbar-link-box-icon notifications-btn-icon <?php echo ($hasNotifications == false ? 'viewed' : ''); ?> fe fe-bell v-middle"></i>
              <div class="dropdown notifications-dropdown box b-white">
                <div class="p-all-20">
                  <?php if(count($notifications) > 0): ?>
                    <?php $i = 0; ?>
                    <?php foreach($notifications as $notification): ?>
                      <a href="<?php echo URL . $notification->location; ?>" class="notification-element" data-notification-id="<?php echo $notification->id; ?>">
                        <div class="list-element p-bottom-15 p-top-15 <?php echo ($i == 0 ? 'first' : ''); ?> <?php echo ($i == (count($notifications) - 1) ? 'last' : ''); ?>">
                          <div class="row">
                            <div class="col-lg-3 p-right-0 text-left">
                              <div class="icon-circle medium notifications-dropdown-box-icon <?php echo ($notification->viewed == 1 ? 'viewed' : ''); ?> b-secondary c-primary text-center">
                                <i class="fe fe-<?php echo $notification->icon; ?> v-middle"></i>
                              </div>
                            </div>
                            <div class="col-lg-9 p-left-0 text-left">
                              <div class="caption c-text"><?php echo $notification->title; ?></div>
                              <div class="notifications-dropdown-box-time text c-gray"><?php echo $notifications_model->formatNotificationDate($notification->notification_date); ?></div>
                            </div>
                          </div>
                        </div>
                      </a>
                      <?php $i++; ?>
                    <?php endforeach; ?>
                  <?php else: ?>
                    <div class="caption c-gray">No notifications.</div>
                  <?php endif; ?>
                </div>
                <div class="dropdown-view-all p-all-5 text-center">
                  <a href="#" class="text c-primary">View all</a>
                </div>
              </div>
            </div>
          </div> -->
          <a href="<?php echo URL; ?>account" class="topbar-link">
            <div class="topbar-link-box topbar-account-image">
              <?php if(file_exists('public/application/accounts/' . $account->id . '.png')): ?>
                <img src="<?php echo URL; ?>public/application/accounts/<?php echo $account->id; ?>.png" class="v-middle">
              <?php else: ?>
                <img src="<?php echo URL; ?>public/img/account.png" class="v-middle">
              <?php endif; ?>
            </div>
          </a>
        </div>
      </div>
    </div>
  </div>
</div>