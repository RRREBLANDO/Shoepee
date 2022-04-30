<div class="custom-modal" id="brand-modal">
    <div class="modal-main">
    <div class="custom-modal-content">
        <div class="custom-modal-header">
            <p>Add Brand</p>
        </div>
        <div class="custom-modal-body">
            <?php require '../partials/error_msg.php' ?>

            <form action="#" method="POST" enctype="multipart/form-data" class="modal-form">
                <div class="form-content">
                    <label for="">Brand Name</label>
                    <input type="text" name="brand" class="brand-name-input" required>
                </div>
                <div class="form-content">
                    <label for="">Brand Status</label>
                    <select name="status" class="brand-status" required>
                        <option value="">Please select</option>
                        <option value="Available" >Available</option>
                        <option value="Unavailable">Unavailable</option>
                    </select>
                </div>
                <div class="form-content">
                    <label for="">Brand Logo</label>
                    <input type="file" name="logo" class="brand-name-input" id="brand-logo" required>
                </div>
                <button type="submit" name="addBrand" class="submit-btn" id="add-brand-submit">Submit</button>
                <button class="close-btn">Close</button>
            </form>
        </div>
    </div>
    </div>
</div>

<div class="custom-modal" id="update-brand-modal">
    <div class="modal-main">
    <div class="custom-modal-content">
        <div class="custom-modal-header">
            <p>Update Brand Status</p>
        </div>
        <div class="custom-modal-body">
            <?php require '../partials/error_msg.php' ?>
            <form action="#" method="POST" enctype="multipart/form-data" class="modal-form">
            <input type="hidden" name="brand_id" class="brand-name-input" value="" id="update-brand-id">
            <div class="form-content">
            <label for="">Brand Name</label>
            <input type="text" class="brand-name-input" value="" id="update-brand-name" disabled>
            </div>
            <div class="form-content">
                <label for="">Brand Status</label>
                <select class="brand-status" name="status">
                    <option value="">Please select</option>
                    <option value="Available">Available</option>
                    <option value="Unavailable">Unavailable</option>
                </select>
            </div>
            <button type="submit" name="updateBrand" class="submit-btn" id="update-brand-submit">Submit</button>
            <button class="close-btn">Close</button>

            </form>
        </div>
    </div>
    </div>
</div>

<div class="dialog" id="delete-brand-dialog">
    <div class="main-dialog">
        <div class="dialog-content">
            <div class="dialog-header">
                <p>Warning</p>
            </div>
            <div class="dialog-body">
                <input type="hidden" class="delete-id">
                <p class="dialog-msg">Do you want to delete the <b>Adidas</b> Brand?</p>
                <div class="dialog-action">
                    <button type="submit" name="deleteBrand" class="confirm-btn" id="update-brand-submit">Yes</button>
                    <button class="close-btn">No</button>
            </div>
            </div>
        </div>
    </div>
</div>

<div class="custom-modal" id="add-product-modal">
    <div class="modal-main">
    <div class="custom-modal-content">
        <div class="custom-modal-header">
            <p>Add Product</p>
        </div>
        <div class="custom-modal-body">
            <?php require '../partials/error_msg.php' ?>
            <form action="#" method="POST" enctype="multipart/form-data" class="modal-form">
                <div class="form-content">
                    <label for="">Product Name</label>
                    <input type="text" name="product_name" class="product-name-input" required>
                </div>
                <div class="form-content">
                    <label for="">Product Price</label>
                    <input type="text" name="product_price" class="product-price-input" required>
                </div>
                <div class="form-content">
                    <label for="">Brand Name</label>
                    <?php echo $brands ?>
                </div>
                <div class="form-content">
                    <label for="">Search Key</label>
                    <input type="text" name="product_searchkey" class="product-searchkey-input" required>
                </div>
                <div class="form-content">
                    <label for="">Product Image</label>
                    <input type="file" name="product_img" id="product-file-input" required>
                </div>
                <button type="submit" class="submit-btn" id="add-product">Submit</button>
                <button class="close-btn">Close</button>
            </form>
        </div>
    </div>
    </div>
</div>

<div class="custom-modal" id="update-product-modal">
    <div class="modal-main">
    <div class="custom-modal-content">
        <div class="custom-modal-header">
            <p>Update Product</p>
        </div>
        <div class="custom-modal-body">
            <?php require '../partials/error_msg.php' ?>
            <form action="#" method="POST" enctype="multipart/form-data" class="modal-form">
                <input type="hidden" name="product_id" class="product-id-input" >
                <div class="form-content">
                    <label for="">Product Name</label>
                    <input type="text" name="product_name" class="product-name-input" required>
                </div>
                <div class="form-content">
                    <label for="">Product Price</label>
                    <input type="text" name="product_price" class="product-price-input" required>
                </div>
                <div class="form-content">
                    <label for="">Brand Name</label>
                    <?php echo $brands ?>
                </div>
                <div class="form-content">
                    <label for="">Product Image</label>
                    <input type="file" name="product_img" id="product-file-input">
                </div>
                <button type="submit" class="submit-btn" id="update-product">Submit</button>
                <button class="close-btn">Close</button>
            </form>
        </div>
    </div>
    </div>
</div>

<div class="custom-modal" id="add-price-modal">
    <div class="modal-main">
    <div class="custom-modal-content">
        <div class="custom-modal-header">
            <p>Add Price Change</p>
        </div>
        <div class="custom-modal-body">
            <?php require '../partials/error_msg.php' ?>
            <form action="#" method="POST" enctype="multipart/form-data" class="modal-form">
                <div class="form-content">
                    <label for="">Product Name</label>
                    <?php echo $products ?>
                </div>
                <div class="form-content">
                    <label for="">Amount</label>
                    <input type="text" name="amount" class="amount-input" required>
                </div>
                <div class="form-content">
                    <label for="">Start Effectivity Date</label>
                    <input type="date" name="start_eff_date" class="start-eff-input" required>
                </div>
                <div class="form-content">
                    <label for="">End Effectivity Date</label>
                    <input type="date" name="end_eff_date" class="end-eff-input" required>
                </div>
                <button type="submit" class="submit-btn" id="add-product">Submit</button>
                <button class="close-btn">Close</button>
            </form>
        </div>
    </div>
    </div>
</div>

<div class="dialog" id="delete-product-dialog">
    <div class="main-dialog">
        <div class="dialog-content">
            <div class="dialog-header">
                <p>Warning</p>
            </div>
            <div class="dialog-body">
                <input type="hidden" class="delete-id">
                <p class="dialog-msg"></p>
                <div class="dialog-action">
                    <button type="submit" name="deleteBrand" class="confirm-btn" id="update-brand-submit">Yes</button>
                    <button class="close-btn">No</button>
            </div>
            </div>
        </div>
    </div>
</div>

<div class="custom-modal" id="add-faq-modal">
    <div class="modal-main">
    <div class="custom-modal-content">
        <div class="custom-modal-header">
            <p>Add FAQ</p>
        </div>
        <div class="custom-modal-body">
            <?php require '../partials/error_msg.php' ?>
            <form action="#" method="POST" enctype="multipart/form-data" class="modal-form">
                <div class="form-content">
                    <label for="">Question</label>
                    <textarea rows="" cols="" name="question" class="question-input" required></textarea>
                </div>
                <div class="form-content">
                    <label for="">Answer</label>
                    <textarea rows="" cols="" name="answer" class="answer-input" required></textarea>
                </div>
                <button type="submit" class="submit-btn" id="faq-submit">Submit</button>
                <button class="close-btn">Close</button>
            </form>
        </div>
    </div>
    </div>
</div>

<div class="custom-modal" id="update-faq-modal">
    <div class="modal-main">
    <div class="custom-modal-content">
        <div class="custom-modal-header">
            <p>Update FAQ</p>
        </div>
        <div class="custom-modal-body">
            <?php require '../partials/error_msg.php' ?>
            <form action="#" method="POST" enctype="multipart/form-data" class="modal-form">
                <input type="hidden" name="faq_id" class="faq-id-input">
                <div class="form-content">
                    <label for="">Question</label>
                    <textarea rows="" cols="" name="question" class="question-input" required></textarea>
                </div>
                <div class="form-content">
                    <label for="">Answer</label>
                    <textarea rows="" cols="" name="answer" class="answer-input" required></textarea>
                </div>
                <button type="submit" class="submit-btn" id="faq-update">Submit</button>
                <button class="close-btn">Close</button>
            </form>
        </div>
    </div>
    </div>
</div>

<div class="dialog" id="delete-faq-dialog">
    <div class="main-dialog">
        <div class="dialog-content">
            <div class="dialog-header">
                <p>Warning</p>
            </div>
            <div class="dialog-body">
                <input type="hidden" class="delete-id">
                <p class="dialog-msg">Do you want to delete this Frequently Ask Question?</p>
                <div class="dialog-action">
                    <button type="submit" name="deleteBrand" class="confirm-btn" id="update-brand-submit">Yes</button>
                    <button class="close-btn">No</button>
            </div>
            </div>
        </div>
    </div>
</div>

<div class="custom-modal" id="add-courier-modal">
    <div class="modal-main">
    <div class="custom-modal-content">
        <div class="custom-modal-header">
            <p>Add Courier Account</p>
        </div>
        <div class="custom-modal-body">
            <?php require '../partials/error_msg.php' ?>
            <form action="#" method="POST" enctype="multipart/form-data" class="modal-form">
                <div class="courier-details">
                    <div class="form-content">
                        <label for="">Firstname</label>
                        <input type="text" name="firstname" class="firstname-input" required>
                    </div>
                    <div class="form-content">
                        <label for="">Lastname</label>
                        <input type="text" name="lastname" class="lastname-input" required>
                    </div>
                    <div class="form-content">
                        <label for="">Address</label>
                        <input type="text" name="address" class="address-input" required>
                    </div>
                    <div class="form-content">
                        <label for="">Age</label>
                        <input type="text" name="age" class="age-input" required>
                    </div>
                    <div class="form-content">
                        <label for="">Phone Number</label>
                        <input type="text" name="phonenumber" class="phonenumber-input" required>
                    </div>
                    <div class="form-content">
                        <label for="">Email</label>
                        <input type="email" name="email" class="email-input" required>
                    </div>
                    <div class="form-content">
                        <label for="">Profile Picture</label>
                        <input type="file" name="profile_pic" id="profile-pic-file-input" required>
                    </div>
                </div>
                <button type="submit" class="submit-btn" id="add-courier-submit">Submit</button>
                <button class="close-btn">Close</button>
            </form>
        </div>
    </div>
    </div>
</div>

<div class="dialog" id="delete-user-dialog">
    <div class="main-dialog">
        <div class="dialog-content">
            <div class="dialog-header">
                <p>Warning</p>
            </div>
            <div class="dialog-body">
                <input type="hidden" class="user-id">
                <p class="dialog-msg"></p>
                <div class="dialog-action">
                    <button type="submit" name="deleteBrand" class="confirm-btn">Yes</button>
                    <button class="close-btn">No</button>
            </div>
            </div>
        </div>
    </div>
</div>

<div class="custom-modal" id="view-items-modal">
    <div class="modal-main">
    <div class="custom-modal-content">
        <div class="custom-modal-header">
            <p class="mb-3">Purchase Items</p>
        </div>
        <div class="custom-modal-body">
            <div class="item-list">
            </div>
            <button class="close-btn">X</button>
        </div>
    </div>
    </div>
</div>

<div class="dialog" id="delete-order-dialog">
    <div class="main-dialog">
        <div class="dialog-content">
            <div class="dialog-header">
                <p>Warning</p>
            </div>
            <div class="dialog-body">
                <input type="hidden" class="order-id">
                <p class="dialog-msg">Do you want to delete this order?</p>
                <div class="dialog-action">
                    <button type="submit" class="confirm-btn">Yes</button>
                    <button class="close-btn">No</button>
            </div>
            </div>
        </div>
    </div>
</div>

<div class="custom-modal" id="update-order-modal">
    <div class="modal-main">
    <div class="custom-modal-content">
        <div class="custom-modal-header">
            <p>Update Order Status</p>
        </div>
        <div class="custom-modal-body">
            <?php require '../partials/error_msg.php' ?>

            <form action="#" method="POST" class="modal-form">
                <input type="hidden" name="order_id">
                <div class="form-content">
                    <label for="">Order Status</label>
                    <select name="status" class="order-status-dropdown" required>
                        <option value="">Please select a status</option>
                        <option value="Pending" >Pending</option>
                        <option value="To Ship">To Ship</option>
                        <option value="To Receive">To Receive</option>
                        <option value="Delivered">Delivered</option>
                        <option value="Cancelled">Cancelled</option>
                    </select>
                </div>
                <button type="submit" name="addBrand" class="submit-btn">Submit</button>
                <button class="close-btn">Close</button>
            </form>
        </div>
    </div>
    </div>
</div>

<div class="custom-modal" id="delivery-details-modal">
    <div class="modal-main">
    <div class="custom-modal-content">
        <div class="custom-modal-header">
            <p>Order Delivery Details</p>
        </div>
        <div class="custom-modal-body">
            <form action="#" method="POST" enctype="multipart/form-data" class="modal-form">
                <input type="hidden" name="order_id" class="order-id-input" >
                <div class="form-content">
                    <label for="">Courier</label>
                    <?php echo $courier ?>
                </div>
                <button type="submit" class="submit-btn" id="update-product">Submit</button>
                <button class="close-btn">Close</button>
            </form>
        </div>
    </div>
    </div>
</div>

<div class="custom-modal" id="view-delivery-details-modal">
    <div class="modal-main">
    <div class="custom-modal-content">
        <div class="custom-modal-header">
        </div>
        <div class="custom-modal-body">
            <div class="delivery">
            </div>
            <button class="close-btn">X</button>
        </div>
    </div>
    </div>
</div>

<div class="custom-modal" id="receipt-modal">
    <div class="modal-main">
    <div class="custom-modal-content">
        <div class="custom-modal-header">
            <p class="shop-name"><i class='bx bxs-shopping-bag-alt' ></i>Shoe<span>pee</span></p>
            <p class="receipt-desc">Official Receipt</p>
        </div>
        <div class="custom-modal-body">
            <div class="item-list">
            </div>
            <div class="receipt-footer">
                <small><i class='bx bx-smile'></i> Thank you for trusting and being with us. <i class='bx bx-smile'></i></small>
            </div>
            <button class="close-btn">X</button>
        </div>
    </div>
    </div>
</div>

<div class="report-dialog">
    <div class="report-header">
        <p class="shop-name"><i class='bx bxs-shopping-bag-alt' ></i>Shoe<span>pee</span></p>
        <p class="receipt-desc">April 22, 2022</p>
        <p class="receipt-desc">Sales Report</p>
        <button class="report-close-btn"><i class='bx bx-x'></i></button>
        <button class="report-print-btn"><i class='bx bx-printer'></i></button>
    </div>
    <div class="report-body">
        <table>
            <thead>
                <tr>
                    <td>Product</td>
                    <td>Price</td>
                    <td>Quantity</td>
                    <td>Amount Received</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>custom nike react element 55</td>
                    <td>P 2000</td>
                    <td>3</td>
                    <td>P 6000</td>
                </tr>
                <tr>
                    <td>custom nike react element 55</td>
                    <td>P 2000</td>
                    <td>3</td>
                    <td>P 6000</td>
                </tr>
                <tr>
                    <td>custom nike react element 55</td>
                    <td>P 2000</td>
                    <td>3</td>
                    <td>P 6000</td>
                </tr>
                <tr>
                    <td>Generated by Shoepee Sales Management</td>
                    <td></td>
                    <td></td>
                    <td>Total Sales Amount : P 12000</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
