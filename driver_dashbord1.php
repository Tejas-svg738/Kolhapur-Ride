<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Driver Dashboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    * {
      box-sizing: border-box;
      font-family: 'Segoe UI', sans-serif;
      margin: 0;
      padding: 0;
    }

    body {
      background-color: #f0f2f5;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 20px;
      min-height: 100vh;
    }

    .dashboard {
      background: #fff;
      padding: 25px;
      border-radius: 12px;
      width: 100%;
      max-width: 500px;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    }

    .dashboard h2 {
      text-align: center;
      margin-bottom: 20px;
      color: #333;
    }

    .section {
      margin-bottom: 20px;
    }

    textarea {
      width: 100%;
      padding: 12px;
      font-size: 15px;
      border-radius: 8px;
      border: 1px solid #ccc;
      resize: vertical;
    }

    .call-btn, .cancel-btn {
      display: inline-block;
      padding: 10px 18px;
      font-size: 15px;
      border-radius: 8px;
      border: none;
      cursor: pointer;
      margin-right: 10px;
    }

    .call-btn {
      background-color: #4CAF50;
      color: white;
    }

    .cancel-btn {
      background-color: #f44336;
      color: white;
    }

    .button-group {
      display: flex;
      justify-content: center;
      gap: 15px;
      flex-wrap: wrap;
    }

    @media (max-width: 480px) {
      .call-btn, .cancel-btn {
        width: 100%;
        margin: 5px 0;
      }

      .button-group {
        flex-direction: column;
        align-items: stretch;
      }
    }
  </style>
</head>
<body>

<div class="dashboard">
  <h2></h2>
 
  <div class="section">
    <label for="message"><strong>✉️ Send Message</strong></label>
    <textarea id="message" rows="4" placeholder="Type your message here..."></textarea>
  </div>

  <div class="button-group">
    <button class="call-btn" onclick="alert('📞 Calling Passenger...')">📞 Call</button>
    <button class="cancel-btn" onclick="alert('❌ Ride Cancelled')">Cancel Ride</button>
  </div>
</div>

</body>
</html>
