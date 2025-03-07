import React from "react";
import { createRoot } from "react-dom/client"; // React 18+ import
import NewApp from "./NewApp.jsx";

// Create a root and mount the App component
const root = createRoot(document.getElementById('app'));
root.render(<NewApp />);

// Unmount the App component after 5 seconds (optional)
setTimeout(() => {
  root.unmount();
}, 5000);