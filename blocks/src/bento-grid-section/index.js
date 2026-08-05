import { registerBlockType } from '@wordpress/blocks';
import Edit from './edit';
import Save from './save';
import metadata from './block.json';
import './style.scss';
import './block-styles';

registerBlockType( metadata.name, {
	edit: Edit,
	save: Save
} );