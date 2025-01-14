const items = [
  "0100007F:0CEA",
  "0100007F:D87A",
  "0100007F:9058",
  "0100007F:8100",
  "0100007F:8100",
  "0100007F:22B8",
  "0100007F:84A6",
  "0100007F:22B8",
  "3185070A:985C",
  "3185070A:93EA",
  "3185070A:D658",
  "3185070A:B3E4",
  "3185070A:E596",
  "3185070A:C0C0",
  "3185070A:CAB8",
  "3185070A:86DC",
  "3185070A:8062",
  "3185070A:E240",
  "3185070A:C406",
  "3185070A:AA22",
  "3185070A:B536",
  "3185070A:CD50",
  "3185070A:D814",
  "3185070A:985E",
  "3185070A:A87C",
  "3185070A:8D1A",
  "3185070A:22B8",
  "3185070A:E338",
  "3185070A:C024",
  "3185070A:86E6",
  "3185070A:D668",
  "3185070A:E21C",
  "3185070A:C25C",
  "3185070A:BE04",
  "3185070A:D674",
  "3185070A:D84C",
  "3185070A:D9A2",
  "3185070A:A6B0",
  "3185070A:C412",
  "3185070A:9FAC",
  "3185070A:C24C",
  "3185070A:93E4",
  "3185070A:C18A",
  "3185070A:AA18",
  "3185070A:A404",
  "3185070A:91D6",
  "3185070A:AA28",
  "00000000:0000",
  // ??
  // "83876464:0050",
  // "37786464:0050",
  // "38786464:0050",
  // "002C7364:0050",
  // "0C786464:0050",
  // "85876464:0050",
  // "87876464:0050",
  // "022C7364:0050",
  // "032C7364:0050",
  // "0D786464:0050",
  // "84876464:0050",
  // "39786464:0050",
  // "BC00000A:0050",
  // "86876464:0050",
  // "3A786464:0050",
  // "032C7364:0050",
];

function toIp(item) {
  const [hexIp, hexPort] = item.split(":");
  let ip = hexIp
    .match(/.{1,2}/g)
    .reverse()
    .map((s) => parseInt(s, 16))
    .join(".");
  ip = ip === "127.0.0.1" ? "localhost" : ip;
  const port = parseInt(hexPort, 16);

  return `http://${ip}:${port}`;
}

const result = items.map(toIp);

console.log(JSON.stringify(result, null, 2));
