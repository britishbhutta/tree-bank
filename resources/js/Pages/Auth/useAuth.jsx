import { createContext, useContext, useState } from "react";
import axios from "axios";

const AuthContext = createContext(null);

export const AuthProvider = ({ children }) => {
  const [user, setUser] = useState(null);

  const fetchUser = async () => {
    try {
      const res = await axios.get("/user", { withCredentials: true });
      setUser(res.data);
    } catch {
      setUser(null);
    }
  };

  const logout = async () => {
    await axios.post("/logout", {}, { withCredentials: true });
    setUser(null); // 🔥 THIS updates UI instantly
  };

  return (
    <AuthContext.Provider value={{ user, fetchUser, logout }}>
      {children}
    </AuthContext.Provider>
  );
};

export const useAuth = () => {
  const ctx = useContext(AuthContext);
  if (!ctx) throw new Error("useAuth must be used inside AuthProvider");
  return ctx;
};
