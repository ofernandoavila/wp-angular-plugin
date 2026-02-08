import { createApplication } from '@angular/platform-browser';
import { appConfig } from '../config/app.config';
import { WebComponentService } from '../config/web-components';
import { App } from '../config/app';

createApplication(appConfig)
	.then((app) => {
		const service = new WebComponentService(app);
		[
			// Insert your web component like this:
			// { elementName: 'your-component', component: YourComponent }

		].map(({ component, elementName }) =>
			service.createWebComponent(elementName, component),
		);
	})
	.catch((err) => console.error(err));
