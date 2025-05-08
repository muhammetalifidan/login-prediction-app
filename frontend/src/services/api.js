import axios from "axios";

const API = axios.create({
    baseURL: "https://login-prediction-app.onrender.com/api",
});

export const fetchPredictions = () => API.get("/predictions");
