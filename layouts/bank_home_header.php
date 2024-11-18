<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>

    <!-- Bootstrap CDN Links -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />

    <!-- icons cdn -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css"
    />
    <link
      href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
      rel="stylesheet"
    />
    <link
      href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
      integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="/assets/css/critical.css" rel="stylesheet" />
    <link href="/assets/css/styles.css" rel="stylesheet" />
    <link href="/assets/css/header.css" rel="stylesheet" />
    <link href="/assets/css/style.css" rel="stylesheet" />
  </head>

  <body>
    <div id="root2" class="">
      <header class="header_with_logo">
        <div class="container-fluid">
          <div class="header-wrapper">
            <div class="d-flex justify-content-between px-4 align-items-center">
              <div class="left-column d-flex align-items-center gap-3">
                <div class="logo">
                  <img src="../assets/images/site_logo.svg" alt="RGA" />
                </div>
                <div class="div">
                  <h2 class="header_username">John Smith</h2>
                </div>
              </div>
              <div
                class="right-column d-flex align-items-center justify-content-evenly"
              >
                <div class="search-bar--wrapper">
                  <div class="search">
                    <i class="material-icons">search</i>
                    <input
                      type="text"
                      placeholder="Search your WordPlace"
                      name="search"
                      id="search"
                    />
                  </div>
                </div>
                <div
                  class="notifications-panel d-flex align-items-center gap-3"
                >
                  <div class="available_balance">
                    <h2 class="the_balance">
                      $<span class="balance_span">23,450.00</span>
                    </h2>
                    <p class="balance_message">Available Balance</p>
                  </div>
                  <div class="notifications">
                    <details>
                        <summary>
                            <span class="material-icons" style="color: #d02128; font-size: 35px">notifications</span>
                        </summary>
                        <div class="details-dropdown">
                            <div class="notification">
                                <div class="logo-image">
                                    <div class="icon">
                                        <object data="/assets/Icons/Risk_Notification.svg"></object>
                                    </div>
                                </div>
                                <div class="notification-body">
                                    <div class="notification-title">
                                        <h2>Understanding your risk appetite can protect your finances and your home.</h2>
                                    </div>
                                    <div class="notification-details">
                                        <p>Find out your risk appetite now.</p>
                                    </div>
                                    <div class="notification-action">
                                        <button class="button primary-button">Risk Vault</button>
                                    </div>
                                </div>
                            </div>
                            <div class="notification">
                                <div class="logo-image">
                                    <div class="icon">
                                        <span>45x45</span>
                                    </div>
                                </div>
                                <div class="notification-body">
                                    <div class="notification-title">
                                        <h2>Your money is already in your account! The $32,000 you withdrew on 05/08/2020 was credited</h2>
                                    </div>
                                    <div class="notification-meta">
                                        <div class="date-mata">
                                            <i class="fa-solid fa-calendar-days"></i>
                                            <span class="date">20 Feb, 2020</span>
                                        </div>
                                        <div class="time-mata">
                                            <i class="fa-regular fa-clock"></i>
                                            <span class="time">12.00 am</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="notification">
                                <div class="logo-image">
                                    <div class="icon">
                                        <span>45x45</span>
                                    </div>
                                </div>
                                <div class="notification-body">
                                    <div class="notification-title">
                                        <h2>We will be in maintenance! We will be offline on 05/07/2020 from 3:00 am to 7:00 am</h2>
                                    </div>
                                    <div class="notification-meta">
                                        <div class="date-mata">
                                            <i class="fa-solid fa-calendar-days"></i>
                                            <span class="date">20 Feb, 2020</span>
                                        </div>
                                        <div class="time-mata">
                                            <i class="fa-regular fa-clock"></i>
                                            <span class="time">12.00 am</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="notification">
                                <div class="logo-image">
                                    <div class="icon">
                                        <span>45x45</span>
                                    </div>
                                </div>
                                <div class="notification-body">
                                    <div class="notification-title">
                                        <h2>Discover the best places to eat
                                            near you. There’s a lot of choice!</h2>
                                    </div>
                                    <div class="notification-meta">
                                        <div class="date-mata">
                                            <i class="fa-solid fa-calendar-days"></i>
                                            <span class="date">20 Feb, 2020</span>
                                        </div>
                                        <div class="time-mata">
                                            <i class="fa-regular fa-clock"></i>
                                            <span class="time">12.00 am</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </details>
                    <span class="notifications-labels">2</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </header>
      <main>
          <div class="body-layout">
            <div class="sidebar">
              <div class="sidebar-container">
                <ul>
                  <li>
                    <a href="#" class="active">
                      <div class="item-tile home">
                        <div class="icon">
                          <img src="/assets/Icons/home.svg" alt="">
                        </div>
                        <div class="title">Home</div>
                      </div>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="item-tile withdraw">
                        <div class="icon"><img src="/assets/Icons/withdraw.svg" alt=""></div>
                        <div class="title">Withdraw</div>
                      </div>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="item-tile transfer">
                        <div class="icon"><img src="/assets/Icons/transfer.svg" alt=""></div>
                        <div class="title">Transfer</div>
                      </div>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="item-tile bill-pay">
                        <div class="icon"><img src="/assets/Icons/bill.svg" alt=""></div>
                        <div class="title">Bill Pay</div>
                      </div>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="item-tile risk-vault">
                        <div class="icon"><img src="/assets/Icons/dollar.svg" alt=""></div>
                        <div class="title">Risk Vault</div>
                      </div>
                    </a>
                  </li>
                </ul>
              </div>
            </div>
            <div class="main_page">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="payment-section inner-section">
                            <div class="section-title d-flex justify-content-between align-items-center">
                                <h2>Payment Request</h2>
                                <div class="view-all-button">
                                    <a href="#">View all +</a>
                                </div>
                            </div>
                            <div class="tile-entries">
                                <div class="entries-wrapper">
                                    <div class="entry_3">
                                        <div class="icon">
                                            <object data="/assets/Icons/wire-white.svg"></object>
                                            <!-- <img src="/assets/Icons/wire.svg" alt=""> -->
                                        </div>
                                        <div class="entry_details">
                                            <h3 class="entry_title">XYZ Company</h3>
                                            <p class="entry_detail">Cable bill</p>
                                        </div>
                                        <div class="entry_amount">
                                            <h3 class="entry-amount">$<span class="transaction_amount">100</span></h3>
                                            <p class="transaction_date">10 Feb, 2020</p>
                                        </div>
                                    </div>
                                    <div class="entry_3">
                                        <div class="icon">
                                            <object data="/assets/Icons/router-white.svg"></object>
                                            <!-- <img src="/assets/Icons/wire.svg" alt=""> -->
                                        </div>
                                        <div class="entry_details">
                                            <h3 class="entry_title">XYZ Company</h3>
                                            <p class="entry_detail">Cable bill</p>
                                        </div>
                                        <div class="entry_amount">
                                            <h3 class="entry-amount">$<span class="transaction_amount">100</span></h3>
                                            <p class="transaction_date">10 Feb, 2020</p>
                                        </div>
                                    </div>
                                    <div class="entry_3">
                                        <div class="icon">
                                            <object data="/assets/Icons/wire-white.svg"></object>
                                            <!-- <img src="/assets/Icons/wire.svg" alt=""> -->
                                        </div>
                                        <div class="entry_details">
                                            <h3 class="entry_title">XYZ Company</h3>
                                            <p class="entry_detail">Cable bill</p>
                                        </div>
                                        <div class="entry_amount">
                                            <h3 class="entry-amount">$<span class="transaction_amount">100</span></h3>
                                            <p class="transaction_date">10 Feb, 2020</p>
                                        </div>
                                    </div>
                                    <div class="entry_3">
                                        <div class="icon">
                                            <object data="/assets/Icons/router-white.svg"></object>
                                            <!-- <img src="/assets/Icons/wire.svg" alt=""> -->
                                        </div>
                                        <div class="entry_details">
                                            <h3 class="entry_title">XYZ Company</h3>
                                            <p class="entry_detail">Cable bill</p>
                                        </div>
                                        <div class="entry_amount">
                                            <h3 class="entry-amount">$<span class="transaction_amount">100</span></h3>
                                            <p class="transaction_date">10 Feb, 2020</p>
                                        </div>
                                    </div>
                                    <div class="entry_3">
                                        <div class="icon">
                                            <object data="/assets/Icons/wire-white.svg"></object>
                                            <!-- <img src="/assets/Icons/wire.svg" alt=""> -->
                                        </div>
                                        <div class="entry_details">
                                            <h3 class="entry_title">XYZ Company</h3>
                                            <p class="entry_detail">Cable bill</p>
                                        </div>
                                        <div class="entry_amount">
                                            <h3 class="entry-amount">$<span class="transaction_amount">100</span></h3>
                                            <p class="transaction_date">10 Feb, 2020</p>
                                        </div>
                                    </div>
                                    <div class="entry_3">
                                        <div class="icon">
                                            <object data="/assets/Icons/router-white.svg"></object>
                                            <!-- <img src="/assets/Icons/wire.svg" alt=""> -->
                                        </div>
                                        <div class="entry_details">
                                            <h3 class="entry_title">XYZ Company</h3>
                                            <p class="entry_detail">Cable bill</p>
                                        </div>
                                        <div class="entry_amount">
                                            <h3 class="entry-amount">$<span class="transaction_amount">100</span></h3>
                                            <p class="transaction_date">10 Feb, 2020</p>
                                        </div>
                                    </div>
                                    <div class="entry_3">
                                        <div class="icon">
                                            <object data="/assets/Icons/wire-white.svg"></object>
                                            <!-- <img src="/assets/Icons/wire.svg" alt=""> -->
                                        </div>
                                        <div class="entry_details">
                                            <h3 class="entry_title">XYZ Company</h3>
                                            <p class="entry_detail">Cable bill</p>
                                        </div>
                                        <div class="entry_amount">
                                            <h3 class="entry-amount">$<span class="transaction_amount">100</span></h3>
                                            <p class="transaction_date">10 Feb, 2020</p>
                                        </div>
                                    </div>
                                    <div class="entry_3">
                                        <div class="icon">
                                            <object data="/assets/Icons/router-white.svg"></object>
                                            <!-- <img src="/assets/Icons/wire.svg" alt=""> -->
                                        </div>
                                        <div class="entry_details">
                                            <h3 class="entry_title">XYZ Company</h3>
                                            <p class="entry_detail">Cable bill</p>
                                        </div>
                                        <div class="entry_amount">
                                            <h3 class="entry-amount">$<span class="transaction_amount">100</span></h3>
                                            <p class="transaction_date">10 Feb, 2020</p>
                                        </div>
                                    </div>
                                    <div class="entry_3">
                                        <div class="icon">
                                            <object data="/assets/Icons/wire-white.svg"></object>
                                            <!-- <img src="/assets/Icons/wire.svg" alt=""> -->
                                        </div>
                                        <div class="entry_details">
                                            <h3 class="entry_title">XYZ Company</h3>
                                            <p class="entry_detail">Cable bill</p>
                                        </div>
                                        <div class="entry_amount">
                                            <h3 class="entry-amount">$<span class="transaction_amount">100</span></h3>
                                            <p class="transaction_date">10 Feb, 2020</p>
                                        </div>
                                    </div>
                                    <div class="entry_3">
                                        <div class="icon">
                                            <object data="/assets/Icons/router-white.svg"></object>
                                            <!-- <img src="/assets/Icons/wire.svg" alt=""> -->
                                        </div>
                                        <div class="entry_details">
                                            <h3 class="entry_title">XYZ Company</h3>
                                            <p class="entry_detail">Cable bill</p>
                                        </div>
                                        <div class="entry_amount">
                                            <h3 class="entry-amount">$<span class="transaction_amount">100</span></h3>
                                            <p class="transaction_date">10 Feb, 2020</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="transaction-section inner-section">
                            <div class="section-title d-flex justify-content-between align-items-center">
                                <h2>Transaction History</h2>
                                <div class="transaction-filter">
                                    <a href="#">Clear Filter</a>
                                    <i class="fa-solid fa-filter"></i>
                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                </div>
                            </div>
                            <div class="filter-wrapper">
                                <div class="transaction-filters filters">
                                    <div class="filter">
                                        <select name="" id="">
                                            <option value="0">Last week</option>
                                        </select>
                                    </div>
                                    <div class="filter">
                                        <select name="" id="">
                                            <option value="0">Transactions</option>
                                        </select>
                                    </div>
                                    <div class="filter">
                                        <select name="" id="">
                                            <option value="0">Status</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="tile-entries">
                                <div class="entries-wrapper">
                                    <div class="entry_3 in_process">
                                        <div class="icon">
                                            <span>45x45</span>
                                            <!-- <img src="/assets/Icons/wire.svg" alt=""> -->
                                        </div>
                                        <div class="entry_details">
                                            <h3 class="entry_title">Jhon Smuith</h3>
                                            <p class="entry_detail">In process</p>
                                        </div>
                                        <div class="entry_amount">
                                            <h3 class="entry-amount">$<span class="transaction_amount">-100</span></h3>
                                            <p class="transaction_date">10 Feb, 2020</p>
                                        </div>
                                    </div>
                                    
                                    <div class="entry_3 mortgage_payment">
                                        <div class="icon">
                                            <object data="/assets/images/site_logo.svg"></object>
                                            <!-- <img src="/assets/Icons/wire.svg" alt=""> -->
                                        </div>
                                        <div class="entry_details">
                                            <h3 class="entry_title">Jhon Smuith</h3>
                                            <p class="entry_detail">mortgage payment</p>
                                        </div>
                                        <div class="entry_amount">
                                            <h3 class="entry-amount">$<span class="transaction_amount">-100</span></h3>
                                            <p class="transaction_date">10 Feb, 2020</p>
                                        </div>
                                    </div>
                                    <div class="entry_3 in_process">
                                        <div class="icon">
                                            <span>45x45</span>
                                            <!-- <img src="/assets/Icons/wire.svg" alt=""> -->
                                        </div>
                                        <div class="entry_details">
                                            <h3 class="entry_title">Jhon Smuith</h3>
                                            <p class="entry_detail">In process</p>
                                        </div>
                                        <div class="entry_amount">
                                            <h3 class="entry-amount">$<span class="transaction_amount">-100</span></h3>
                                            <p class="transaction_date">10 Feb, 2020</p>
                                        </div>
                                    </div>
                                    <div class="entry_3 in_process">
                                        <div class="icon">
                                            <span>45x45</span>
                                            <!-- <img src="/assets/Icons/wire.svg" alt=""> -->
                                        </div>
                                        <div class="entry_details">
                                            <h3 class="entry_title">Jhon Smuith</h3>
                                            <p class="entry_detail">In process</p>
                                        </div>
                                        <div class="entry_amount">
                                            <h3 class="entry-amount">$<span class="transaction_amount">-100</span></h3>
                                            <p class="transaction_date">10 Feb, 2020</p>
                                        </div>
                                    </div>
                                    <div class="entry_3 in_process">
                                        <div class="icon">
                                            <span>45x45</span>
                                            <!-- <img src="/assets/Icons/wire.svg" alt=""> -->
                                        </div>
                                        <div class="entry_details">
                                            <h3 class="entry_title">Jhon Smuith</h3>
                                            <p class="entry_detail">In process</p>
                                        </div>
                                        <div class="entry_amount">
                                            <h3 class="entry-amount">$<span class="transaction_amount">-100</span></h3>
                                            <p class="transaction_date">10 Feb, 2020</p>
                                        </div>
                                    </div>
                                    <div class="entry_3 in_process">
                                        <div class="icon">
                                            <span>45x45</span>
                                            <!-- <img src="/assets/Icons/wire.svg" alt=""> -->
                                        </div>
                                        <div class="entry_details">
                                            <h3 class="entry_title">Jhon Smuith</h3>
                                            <p class="entry_detail">In process</p>
                                        </div>
                                        <div class="entry_amount">
                                            <h3 class="entry-amount">$<span class="transaction_amount">-100</span></h3>
                                            <p class="transaction_date">10 Feb, 2020</p>
                                        </div>
                                    </div>
                                    <div class="entry_3 in_process">
                                        <div class="icon">
                                            <span>45x45</span>
                                            <!-- <img src="/assets/Icons/wire.svg" alt=""> -->
                                        </div>
                                        <div class="entry_details">
                                            <h3 class="entry_title">Jhon Smuith</h3>
                                            <p class="entry_detail">In process</p>
                                        </div>
                                        <div class="entry_amount">
                                            <h3 class="entry-amount">$<span class="transaction_amount">-100</span></h3>
                                            <p class="transaction_date">10 Feb, 2020</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bottom-navigation">
                <i class="fa-solid fa-house"></i>
                <i class="fa-solid fa-plus"></i>
                <i class="material-icons">leaderboard</i>
                <i class="fa-regular fa-user"></i>
            </div>
        </div>
      </main>
    </div>
  </body>
</html>
