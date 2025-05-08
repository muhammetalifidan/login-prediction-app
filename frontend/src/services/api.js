import axios from "axios";

const API = axios.create({
    baseURL: "http://localhost/api",
});

export const fetchPredictions = () => API.get("/predictions");
