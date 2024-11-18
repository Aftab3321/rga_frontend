<?php 

$page_name = $_SERVER['PHP_SELF'];
?>
<div class="sidebar <?php echo (isset($desktop_only_sidebar)) ? "desktop-only" : "" ?>">
    <div class="sidebar-container">
        <ul>
            <li>
                <a href="/" class="<?php echo (strpos($page_name, "index") > 0) ? "active" : ""; ?>">
                    <div class="item-tile home">
                        <div class="icon">
                            <img src="/assets/Icons/home.svg" alt="">
                        </div>
                        <div class="title">Home</div>
                    </div>
                </a>
            </li>
            <li>
                <a href="#" class="<?php echo (strpos($page_name, "withdraw") > 0) ? "active" : ""; ?>">
                    <div class="item-tile withdraw">
                        <div class="icon"><img src="/assets/Icons/withdraw.svg" alt=""></div>
                        <div class="title">Withdraw</div>
                    </div>
                </a>
            </li>
            <li>
                <a href="#" class="<?php echo strpos($page_name, "transfer" ) > 0 ? "active" : ""; ?>">
                    <div class="item-tile transfer">
                        <div class="icon"><img src="/assets/Icons/transfer.svg" alt=""></div>
                        <div class="title">Transfer</div>
                    </div>
                </a>
            </li>
            <li>
                <a href="/bill_pay" class="<?php echo strpos($page_name, "bill_pay") > 0 ? "active" : ""; ?>">
                    <div class="item-tile bill-pay">
                        <div class="icon"><img src="/assets/Icons/bill.svg" alt=""></div>
                        <div class="title">Bill Pay</div>
                    </div>
                </a>
            </li>
            <li>
                <a href="/bank_home" class="<?php echo strpos($page_name, "bank_home" ) > 0 ? "active" : ""; ?>">
                    <div class="item-tile risk-vault">
                        <div class="icon"><img src="/assets/Icons/dollar.svg" alt=""></div>
                        <div class="title">Risk Vault</div>
                    </div>
                </a>
            </li>
        </ul>
    </div>
</div>