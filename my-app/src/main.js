// index.js (or your entry file)
import React from 'react';
import { createRoot } from 'react-dom/client'; // React 18+ import
import App from './App'; // Import the App component

// Create a root and mount the App component
const rootElement = document.getElementById('root'); // Ensure this matches your HTML
if (rootElement) {
  const root = createRoot(rootElement);
  root.render(<App />);

  // Unmount the App component after 5 seconds (optional)
  setTimeout(() => {
    console.log("Timer triggered!"); // Debugging log
    console.log("Unmounting app...");
    root.unmount();
  }, 5000); // 5000ms = 5 seconds
} else {
  console.error("Root element not found!");
}