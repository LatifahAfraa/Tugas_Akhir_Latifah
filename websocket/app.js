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

const PORT_HTTP = 3005;
httpServer.listen(PORT_HTTP, () => {
    console.log(`Example app listening at ${PORT_HTTP}`);
});
