const Layout = ({ children }) => {
    return (
      <div className="min-h-screen bg-gray-50 text-gray-800 p-4 md:p-8">
        <h1 className="text-xl md:text-3xl font-bold mb-6">Kullanıcı Oturum Tahminleri</h1>
        {children}
      </div>
    );
  };
  
  export default Layout;
  