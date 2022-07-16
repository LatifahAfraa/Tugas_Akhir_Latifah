const express = require("express");
const http = require("http");

const app = express();
const httpServer = http.createServer(app);
const httpSocket = require("socket.io")(httpServer, {
    cors: {
      origin: '*',
    },
  });

const bodyParser = require("body-parser");
app.use(bodyParser.json());
app.use(bodyParser.urlencoded({ extended: true }));

app.get("/", (req, res) => {
    res.status(200).send("Haloo");
});

app.post("/to-socket", express.json(), async (req, res) => {
    const { event_name, datas } = req.body;
    httpSocket.emit(event_name, datas);

    res.status(200).json({status: true, msg: "Data telah diteruskan"})
});

app.get("/lampu", (req, res) => {
  var current_lamp = "lampu_1";

  var response = [
    "lampu_1",
    "lampu_2",
    "lampu_3"
  ];
  var lampu = {
    lampu_1:  1,
    lampu_2 : 3,
    lampu_3: 3
  }
  setInterval(() => {
    response.forEach((val, key) => {
      if(val == current_lamp) {
        if(key == 3) {
          key = 1;
          current_lamp= response[1];
        } else {
          key++;
          current_lamp= response[key];
        }
      }
    });

    lampu.lampu_1 = ("lampu_1" == current_lamp)? 1 : 3;
    lampu.lampu_2 = ("lampu_2" == current_lamp)? 1 : 3;
    lampu.lampu_3 = ("lampu_3" == current_lamp)? 1 : 3;

    console.log(lampu);
  }, 5000);
});

const PORT_HTTP = 3005;
httpServer.listen(PORT_HTTP, () => {
    console.log(`Example app listening at ${PORT_HTTP}`);
});
