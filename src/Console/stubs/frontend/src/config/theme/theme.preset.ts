import { definePreset } from '@primeuix/themes';
import Aura from '@primeuix/themes/aura';
import FloatLabelTokens from './floatlabel.preset';
import InputTextTokens from './inputtext.preset';
import SelectTokens from './select.preset';

export function ThemePreset() {
	return definePreset(Aura, {
		semantic: {
			primary: {
				50: '{blue.50}',
				100: '{blue.100}',
				200: '{blue.200}',
				300: '{blue.300}',
				400: '{blue.400}',
				500: '{blue.500}',
				600: '{blue.600}',
				700: '{blue.700}',
				800: '{blue.800}',
				900: '{blue.900}',
				950: '{blue.950}',
			}
		},
		components: {
			floatlabel: FloatLabelTokens,
			inputtext: InputTextTokens,
			select: SelectTokens,
		},
	});
}