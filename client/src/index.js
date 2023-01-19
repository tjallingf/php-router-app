import { createElement } from 'react';
import { createRoot } from 'react-dom/client';
import App from './scripts/components/App.jsx';
import './main.scss';

createRoot(document.getElementById('root')).render(createElement(App));