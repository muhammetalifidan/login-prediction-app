import { useEffect, useState } from "react";
import { fetchPredictions } from "./services/api";
import UserPredictionTable from "./components/UserPredictionTable";
import Layout from "./components/Layout";

function App() {
  const [users, setUsers] = useState([]);

  useEffect(() => {
    fetchPredictions().then((res) => {
      setUsers(res.data.data);
    });
  }, []);

  return (
    <Layout>
      <UserPredictionTable users={users} />
    </Layout>
  );
}

export default App;
