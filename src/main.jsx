import React from 'react';
import ReactDOM from 'react-dom/client';
import './style.scss'; // Changed from .css to .scss

// A simple React component
function App() {
  console.log('React is running!');
  return null; // We are not rendering anything to the screen yet
}

// This part is just to get React running on the page
const rootEl = document.createElement('div');
rootEl.id = 'react-root';
document.body.append(rootEl);
const root = ReactDOM.createRoot(rootEl);
root.render(
  <React.StrictMode>
    <App />
  </React.StrictMode>
);