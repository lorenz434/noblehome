<?php
include 'header.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>FAQs - Noble Home Construction</title>
  <link rel="stylesheet" href="../css/faqs.css">
</head>
<body>

  <div class="faq-wrapper">
<!-- Left Column for Logo and Contact Info  -->
<div class="faq-left">
  <h1>Frequently Asked Questions</h1>
  <p>Find answers to common inquiries about our products and services.</p>
  <p>For inquiries, you can email us at <a href="mailto:support@noblehomeconstruction.com">support@noblehomeconstruction.com</a> or call us at <strong>(123) 456-7890</strong>.</p>
  </a>
</div>


    <!-- Right Column for FAQs -->
    <div class="faq-right">


      <div class="faq-container">
        <div class="faq-item">
          <button class="faq-question">What types of construction products do you offer?</button>
          <div class="faq-answer">
            We provide a wide range of construction materials including marine boards, laminated panels, WPC outdoor decks, fiber cement boards, and modular cabinetry systems.
          </div>
        </div>

        <div class="faq-item">
          <button class="faq-question">Do you offer installation services?</button>
          <div class="faq-answer">
            Yes, we offer complete services including design consultation, fabrication, delivery, and professional installation.
          </div>
        </div>

        <div class="faq-item">
          <button class="faq-question">Can I request custom orders or bulk pricing?</button>
          <div class="faq-answer">
            Absolutely. We accommodate custom designs and bulk orders. Contact us directly for quotes and lead time.
          </div>
        </div>

        <div class="faq-item">
          <button class="faq-question">What are your delivery options?</button>
          <div class="faq-answer">
            We offer nationwide delivery with scheduled drop-offs. Fees vary based on location and order size.
          </div>
        </div>

        <div class="faq-item">
          <button class="faq-question">What is your return and exchange policy?</button>
          <div class="faq-answer">
            Returns are accepted within 30 days if the items are unused and in original packaging. Custom items may not be returnable.
          </div>
        </div>

        <div class="faq-item">
          <button class="faq-question">Do you provide warranties on your products?</button>
          <div class="faq-answer">
            Yes, selected products come with warranties. Terms and periods vary. Check product details or contact support.
          </div>
        </div>

        <div class="faq-item">
          <button class="faq-question">How can I contact customer support?</button>
          <div class="faq-answer">
            You can call us at (123) 456-7890 or email us at support@noblehomeconstruction.com. We’re available Mon–Fri, 9 AM – 6 PM.
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    document.querySelectorAll('.faq-question').forEach(button => {
      button.addEventListener('click', () => {
        const item = button.closest('.faq-item');
        item.classList.toggle('active');
      });
    });
  </script>

</body>

<?php
include 'footer.php';
?>
</html>
