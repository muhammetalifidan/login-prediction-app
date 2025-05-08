import UserPredictionRow from "./UserPredictionRow";

const UserPredictionTable = ({ users }) => {
  return (
    <div className="overflow-x-auto">
      <table className="min-w-full bg-white border border-gray-200 rounded text-sm md:text-base">
        <thead className="bg-gray-100 text-left">
          <tr>
            <th className="p-2 border">Kullanıcı</th>
            <th className="p-2 border">Son Giriş</th>
            <th className="p-2 border">Ortalama Aralık</th>
            <th className="p-2 border">Haftalık Patern</th>
            <th className="p-2 border">Medyan Aralık</th>
            <th className="p-2 border">Saat Bazlı</th>
          </tr>
        </thead>
        <tbody>
          {users.map((user) => (
            <UserPredictionRow key={user.id} user={user} />
          ))}
        </tbody>
      </table>
    </div>
  );
};

export default UserPredictionTable;
