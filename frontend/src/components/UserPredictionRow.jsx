const UserPredictionRow = ({ user }) => {
    const formatDate = (dateStr) => {
      if (!dateStr) return "-";
      const date = new Date(dateStr);
      return date.toLocaleString("tr-TR");
    };
  
    return (
      <tr className="hover:bg-gray-50">
        <td className="p-2 border">{user.name}</td>
        <td className="p-2 border">{formatDate(user.last_login)}</td>
        <td className="p-2 border">{formatDate(user.predictions.average_interval_prediction)}</td>
        <td className="p-2 border">{formatDate(user.predictions.weekday_pattern_prediction)}</td>
        <td className="p-2 border">{formatDate(user.predictions.median_interval_prediction)}</td>
        <td className="p-2 border">{formatDate(user.predictions.hour_based_pattern_prediction)}</td>
      </tr>
    );
  };
  
  export default UserPredictionRow;
  